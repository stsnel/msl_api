<?php

namespace App\Http\Controllers;

use App\CkanClient\Client;
use App\CkanClient\Request\OrganizationListRequest;
use App\CkanClient\Request\PackageSearchRequest;
use App\CkanClient\Request\PackageShowRequest;
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

    public function dataPublications()
    {
        $client = new Client();
        $request = new PackageSearchRequest();
        $request->filterQuery = "type:data-publication";

        $result = $client->get($request);

        //dd($result);

        return view('frontend.data-access');
    }
    
    public function labs()
    {
        $client = new Client();
        $request = new PackageSearchRequest();
        $request->filterQuery = "type:lab";

        $result = $client->get($request);

        return view('frontend.labs');
    }

    public function dataRepositories()
    {
        $client = new Client();
        $request = new OrganizationListRequest();

        $result = $client->get($request);

        if(!$result->isSuccess()) {
            abort(404, 'ckan request failed');
        }

        return view('frontend.data-repositories', ['repositories' => $result->getResults()]);
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

    public function dataPublication($id)
    {
        $client = new Client();
        $request = new PackageShowRequest();
        $request->id = $id;

        $result = $client->get($request);

        if(!$result->isSuccess()) {
            abort(404, 'ckan request failed');
        }

        return view('frontend.data-publication-detail', ['data' => $result->getResults()]);
    }
    
}
