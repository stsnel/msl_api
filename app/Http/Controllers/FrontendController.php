<?php

namespace App\Http\Controllers;

use App\CkanClient\Client;
use App\CkanClient\Request\OrganizationListRequest;
use App\CkanClient\Request\PackageSearchRequest;
use App\CkanClient\Request\PackageShowRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function dataPublications(Request $request)
    {
        $resultsPerPage = 10;

        $client = new Client();
        $SearchRequest = new PackageSearchRequest();
        $SearchRequest->addFilterQuery("type", "data-publication");        
        $SearchRequest->rows = $resultsPerPage;
        
        $page = $request->page ?? 1;
        $SearchRequest->start = ($page-1) * $resultsPerPage;

        $query = $request->query('query') ?? "";
        $SearchRequest->query = $query;
        
        $SearchRequest->loadFacetsFromConfig('data-publications');

        $activeFilters = [];

        foreach($request->query() as $key => $values) {
            if(array_key_exists($key, config('ckan.facets.data-publications'))) {
                foreach($values as $value) {
                    $activeFilters[$key][] = $value;
                    $SearchRequest->addFilterQuery($key, $value);
                }
            }
        }

        $result = $client->get($SearchRequest);

        $paginator = $this->getPaginator($request, [], $result->getTotalResultsCount(), $resultsPerPage);

        return view('frontend.data-access', ['result' => $result, 'paginator' => $paginator, 'activeFilters' => $activeFilters]);
    }
        
    public function labs()
    {
        $client = new Client();
        $request = new PackageSearchRequest();
        //$request->filterQuery = "type:lab";

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

        return view('frontend.data-repositories', ['repositories' => $result->getResult()]);
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

        return view('frontend.data-publication-detail', ['data' => $result->getResult()]);
    }

    private function getPaginator(Request $request, $items, $total, $resultsPerPage)
    {
        $page = $request->page ?? 1;
        $offset = ($page - 1) * $resultsPerPage;
        $items = array_slice($items, $offset, $resultsPerPage);

        return new LengthAwarePaginator($items, $total, $resultsPerPage, $page, [
            'path' => $request->url(),
            'query' => $request->query()
        ]);
    }
    
}
