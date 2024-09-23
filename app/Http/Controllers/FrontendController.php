<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.index');
    }

    public function dataAccess()
    {
        return view('frontend.data-access');
    }
    
    public function labs()
    {
        return view('frontend.labs');
    }

    public function dataRepositories()
    {
        return view('frontend.data-repositories');
    }

    public function contributeResearcher()
    {
        return view('frontend.contribute-researcher');
    }

    public function contributeRepository()
    {
        return view('frontend.contribute-repository');
    }

    public function about()
    {
        return view('frontend.about');
    }
    
}
