<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return $request->user('participant')->hasVerifiedEmail()
                    ? redirect()->intended('participant/register/page3')
                    : view('Participant/verify-email');
    }
}
