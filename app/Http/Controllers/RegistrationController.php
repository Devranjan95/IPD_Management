<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;



class RegistrationController extends Controller
{
    public function index(){
        return view('backend.registration');
    }
}
