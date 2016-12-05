<?php

use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
}
