<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        $data = $request->toArray();
        $username = $data['username'];
        $password = $data['password'];

        print_r($data);
    }
}
