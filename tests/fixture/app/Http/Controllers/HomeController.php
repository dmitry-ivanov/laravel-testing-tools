<?php

namespace Illuminated\TestingTools\Tests\Fixture\App\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
}
