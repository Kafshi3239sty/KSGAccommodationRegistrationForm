<?php

namespace App\Http\Controllers;

use App\Models\Accommodate;
use App\Models\Admin as ModelsAdmin;
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
            return redirect('adminlogin')->withErrors([
                'National_id' => 'Invalid National ID or Passport',
            ]);
        }
    }

    public function AdmDashboard()
    {

        return view('Admin/dashboard');
    }


    public function Checkins(){
        return view('Admin/allocation');
    }

    public function allocate(Request $request)
    {
        $admin = auth()->guard('admin')->user();
        $acc = new Accommodate();
        $acc->Course_id = $admin->Course_id;
        $acc->Participant_id = $request->Participant_id;
        $acc->Admin_id = $request->Admin_id;
        $acc->hostel = $request->hostel;
        $acc->room_no = $request->room_no;
        $acc->save();
        return redirect('adminlogin');
    }
}
