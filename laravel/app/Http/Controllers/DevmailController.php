<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeDeveloper;

class DevmailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Mail::to('radityadp7224@gmail.com')
        //     ->send(new WelcomeDeveloper());

        // return response()->json([
        //     'message' => 'Email sent successfully!'
        // ]);
    }
}
