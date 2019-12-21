<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Returns the index page 
    public function index(){
        $title = 'Startsida';
        return view('pages/index')->with('title', $title);
    }
}