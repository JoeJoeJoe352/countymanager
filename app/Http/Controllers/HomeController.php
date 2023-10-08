<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    const API_KEY = "f906dbbba23755d0eba8cbdc1b670cbe";
    
    /**
     * Alkalmazás kezelőfelülete.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome', [
            "apiKey" => self::API_KEY,
        ]);
    }
}
