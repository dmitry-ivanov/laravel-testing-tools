<?php

namespace Illuminated\Testing\Tests\App\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    /**
     * The index action.
     */
    public function index()
    {
        return view('home.index');
    }
}
