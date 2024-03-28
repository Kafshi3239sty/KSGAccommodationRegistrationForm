<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Gender;
use App\Models\Med_details;
use App\Models\Nationalities;
use App\Models\NOK;
use App\Models\Participant as ModelsParticipant;
use App\Models\Work_profile;
use Illuminate\Http\Request;
use  Dinushchathurya\NationalityList\Nationality;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Mail;
use App\Mail\ParticipantMail;
use App\Models\Accommodate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail as FacadesMail;

class Participant extends Controller
{
    //Done
    public function retrieve()
    {

        $nationalities = Nationalities::all();
        $genders = Gender::all();
        return view('auth/register', ['nationalities' => $nationalities, 'genders' => $genders]); // Returns all nationalities 
    }

    #Done
    public function proceed(Request $request)
    {


        $part = new ModelsParticipant();
        $part->user_id = 2;
        $part->National_id = $request->Passport;
        $part->Full_Names = $request->name;
        $part->Gender = $request->Gender;
        $part->Mobile_No = $request->mobile_no;
        $part->Address = $request->address;
        $part->Country = $request->Nationality;
        $part->save();

        event(new Registered($part));

        Auth::guard('participant')->login($part);
        return redirect('participant/register/page2');
    }

    public function loginpage()
    {

        return view('Participant/login');
    }

    public function login(Request $request)
    {

        // Validate the form data
        $credentials =  $request->validate([
            'National_id' => 'required|numeric',
        ]);

        // Retrieve the participant based on the National_id
        $participant = ModelsParticipant::where('National_id', $credentials['National_id'])->first();
        $course = Course::where('National_id', $participant)->get();

        if ($participant) {
            // Authenticate the participant
            Auth::guard('participant')->login($participant);
            return redirect('participant/dashboard');
        } else {
            // Participant not found
            return redirect('participant/login')->withErrors([
                'National_id' => 'Invalid National ID or Passport',
            ]);
        }
    }

    public function confirmpage()
    {

        return view('auth/confirmID');
    }

    public function confirm(Request $request)
    {
        // Validate the form data
        $credentials =  $request->validate([
            'National_id' => 'required|numeric',
        ]);

        // Retrieve the participant based on the National_id
        $participant = ModelsParticipant::where('National_id', $credentials['National_id'])->first();
        $course = Course::where('National_id', $participant)->get();

        if ($participant) {
            // Authenticate the participant
            Auth::guard('participant')->login($participant);
            return redirect('participant/register/page3');
        } else {
            // Participant not found
            return redirect('participant/register/page2')->withErrors([
                'National_id' => 'Invalid National ID or Passport',
            ]);
        }
    }





    public function course()
    {

        return view('auth/course');
    }


    public function submit_c(Request $request)
    {
        $part = auth()->guard('participant')->user();
        $cour = new Course();
        $cour->National_id = $part->National_id;
        $cour->Course_Title = $request->name;
        $cour->From = $request->From;
        $cour->To = $request->To;
        $cour->save();

        return redirect('participant/register/page4');
    }

    #View set
    public function work_profile()
    {

        return view('auth/work-profile');
    }

    #Not yet
    public function submit_wp(Request $request)
    {

        $part = auth()->guard('participant')->user();
        $work_p = new Work_profile();
        $work_p->National_id = $part->National_id;
        $work_p->Spons_org = $request->org;
        $work_p->Work_st = $request->work;
        $work_p->save();


        return redirect('participant/register/page5');
    }

    #View set but functionalities not added yet
    public function med_details()
    {

        return view('auth/med-details');
    }

    #Not yet
    public function submit_md(Request $request)
    {

        $part = auth()->guard('participant')->user();
        $med_d = new Med_details();
        $med_d->Hospital = $request->hosp;
        $med_d->National_id = $part->National_id;
        $med_d->Payment_mode = $request->showmodes;
        $med_d->Policy_provider = $request->prov;
        $med_d->Policy_no = $request->policy_no;
        $med_d->Med_condition = $request->Medical_Description;
        $med_d->save();

        return  redirect('participant/register/page6');
    }

    #View set
    public function kin()
    {

        return view('auth/kin');
    }

    #Not yet
    public function submit_kin(Request $request)
    {


        $nok = new NOK();
        $nok->user_id = 3;
        $nok->Full_Names = $request->name;
        $nok->Relationship = $request->relationship;
        $nok->Mobile_No = $request->mobile_no;
        $nok->Address = $request->address;
        $nok->save();

        return redirect('participant/dashboard')->with('status', 'Your are successfully registered');
    }

    public function viewDashboard()
    {

        $part = auth()->guard('participant')->user();

        $course = Course::where('National_id', $part->National_id)->get();
        $header = 'Dashboard';
        $slot = "You're registered!";

        return view('dashboard', ['part' => $part, 'course' => $course, 'header' => $header, 'slot' => $slot]);
    }

    public function check_in(Request $request)
    {
        $part = auth()->guard('participant')->user();
        $courseId = $request->input('cours');

        $course = Course::where('National_id', $part->National_id)
            ->where('id', $courseId)
            ->first();

        if ($course) {
            $att = new Accommodate();
            $att->Participant_id = $part->National_id;
            $att->Course_id = $courseId;
            $att->Check_in = Carbon::now();
            $att->save();

            return redirect('participant/dashboard/wait'); // Redirect to the wait area
        } else {
            // Handle the case where the participant is not associated with any course
            // You might want to display an error message or handle this case differently
            return redirect()->back()->with('error', 'You are not associated with any course.');
        }
    }

    public function checkinsCount()
    {
        return Accommodate::where('Check_out_by', null)->where('Check_out', null)->get();
    }

    public function waitarea()
    {

        $part = auth()->guard('participant')->user();
        $checkins = Accommodate::where('Check_out_by', null)->where('Participant_id', $part->National_id)->where('Check_out', null)->get();

        return view('waitarea', ['part' => $part, 'checkins' => $checkins]);
    }


    public function checkout(Request $request, $id)
    {
        $acc = Accommodate::find($id);
        $acc->Check_out = Carbon::now();
        $acc->save();
        return redirect('participant/dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('participant')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/Login');
    }
}
