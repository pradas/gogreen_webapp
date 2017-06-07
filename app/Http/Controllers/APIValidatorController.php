<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIValidatorController extends APIController
{
    public function validateEmail(Request $request)
    {
        if ($this->isValidParameter($request->email)) {
            if(User::where('email', $request->email)->first() != null)
                return response()->json(['message' => 'Correct email.']);
            else
                return response()->json(['error' => 'Invalid email.'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['error' => 'Email not found.'], Response::HTTP_BAD_REQUEST);

    }

    public function resetPassword(Request $request)
    {
        if ($this->isValidParameter($request->email) && $this->isValidParameter($request->password)) {
            $user = User::where('email', $request->email)->first();
            if($user != null) {
                $user->password = bcrypt($request->password);
                $user->save();
                return response()->json(['message' => 'Password reseted.']);
            }
            else
                return response()->json(['error' => 'Invalid email.'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['error' => 'Email not found.'], Response::HTTP_BAD_REQUEST);
    }
}
