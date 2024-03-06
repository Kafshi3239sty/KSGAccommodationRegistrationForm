<?php

namespace App\Http\Controllers;

use App\Models\Accommodate;
use App\Models\Admin as ModelsAdmin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin extends Controller
{
    //
    public function loginpage()
    {

        return view('Admin/adminlogin');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $credentials =  $request->validate([
            'National_id' => 'required|numeric',
        ]);

        // Retrieve the adminicipant based on the National_id
        $admin = ModelsAdmin::where('National_id', $credentials['National_id'])->first();

        if ($admin) {
            // Authenticate the adminicipant
            Auth::guard('admin')->login($admin);
            return redirect('admin/dashboard');
        } else {
            // adminicipant not found
            return redirect('admin/Login')->withErrors([
                'National_id' => 'Invalid National ID or Passport',
            ]);
        }
    }

    public function AdmDashboard()
    {
        $checkins = Accommodate::where('Check_in_by', null)->get();
        return view('Admin/dashboard', ['checkins' => $checkins])->with('checkins', $checkins);
    }


    public function Checkins()
    {

        $checkins = Accommodate::where('Check_in_by', null)->get();

        return view('Admin/allocate', ['checkins' => $checkins])->with('checkins', $checkins);
    }

    public function checkinsCount()
    {
        return Accommodate::where('Check_in_by', null)->get();
    }

    public function Checkinpart($id)
    {
        $acc = Accommodate::find($id);
        return view('Admin/checkin', ['acc' => $acc]);
    }

    public function allocate(Request $request, $id)
    {
        $acc = Accommodate::find($id);
        $admin = auth()->guard('admin')->user();
        $acc->Admin_id = $admin->National_id;
        $acc->Hostels = $request->Residential;
        $acc->Room_No = $request->Room;
        $acc->Check_in_by = Carbon::now();
        $acc->save();
        return redirect('admin/dashboard');
    }

    public function checkoutsCount()
    {
        return Accommodate::where('Check_out_by', null)->get();
    }

    public function Checkouts()
    {

        $checkouts = Accommodate::where('Check_out_by', null)->get();

        return view('Admin/outallocate', ['checkouts' => $checkouts]);
    }


    public function checkoutby(Request $request, $id)
    {
        $acc = Accommodate::find($id);
        $acc->Check_out_by = Carbon::now();
        $acc->save();
        return redirect('admin/dashboard');
    }
}
