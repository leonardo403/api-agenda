<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

//"2|6WuDhcXEq7Qx9LI8IX8D2vIuhMcelwBJDGvA3fNg2d6ff07d"
//3|rsnCQk9vZtPPba0owqsJuMFSeQowGobn7wgcEXxld42ae317
class AuthController extends Controller
{
    use HttpResponse;

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email','password'))) {
            return $this->response('Authorized', HttpStatusCode::HTTP_OK,[
                'token' => $request->user()->createToken('Agenda', ['agenda-store'])->plainTextToken
            ]);
        }
        return $this->response('Not Authorized', HttpStatusCode::HTTP_FORBIDDEN);
    }

    public function logout()
    {
        # code...
    }
}
