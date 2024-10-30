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
     * Show the Index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.index');
    }

    /**
     * Show the data-publications/data-access page
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
        
        $sort = $request->query('sort') ?? "";
        $SearchRequest->sortField = $sort;

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

        if(!$result->isSuccess()) {
            abort(404, 'ckan request failed');
        }

        $paginator = $this->getPaginator($request, [], $result->getTotalResultsCount(), $resultsPerPage);

        return view('frontend.data-access', ['result' => $result, 'paginator' => $paginator, 'activeFilters' => $activeFilters, 'sort' => $sort]);
    }
        
    /**
     * Show the lab page
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function labs()
    {
        $client = new Client();
        $SearchRequest = new PackageSearchRequest();
        $SearchRequest->addFilterQuery("type", "lab");

        $result = $client->get($SearchRequest);

        return view('frontend.labs');
    }

    /**
     * Show the data-repositories page
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
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

    /**
     * Show the contribute as researcher page
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contributeResearcher()
    {
        return view('frontend.contribute-researcher');
    }

    /**
     * Show the contribute as repository page
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contributeRepository()
    {
        return view('frontend.contribute-repository');
    }

    /**
     * Show the about page
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        return view('frontend.about');
    }

    /**
     * Show the data-publication page
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
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

    /**
     * Get a paginator object
     * 
     * @return LengthAwarePaginator
     */
    private function getPaginator(Request $request, array $items, int $total, int $resultsPerPage): LengthAwarePaginator
    {
        $page = $request->page ?? 1;
        $offset = ($page - 1) * $resultsPerPage;
        $items = array_slice($items, $offset, $resultsPerPage);

        return new LengthAwarePaginator($items, $total, $resultsPerPage, $page, [
            'path' => $request->url(),
            'query' => $request->query()
        ]);
    }

    /**
     * Show theme test page
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function themeTest()
    {
        return view('frontend.themeTest');
    }
    
}
