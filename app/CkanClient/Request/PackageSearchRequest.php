<?php
namespace App\CkanClient\Request;

use App\CkanClient\Response\BaseResponse;
use App\CkanClient\Response\PackageSearchResponse;

class PackageSearchRequest implements RequestInterface
{

    /**
     * @var string endpoint in CKAN used for this request;
     */
    private $endpoint = 'action/package_search';

    /**
     * @var string method of request
     */
    private $method = 'GET';

    /**
     * @var string class for creating result object
     */
    private $responseClass = PackageSearchResponse::class;

    public $query;

    public $filterQuery;

    public $rows;

    public $start;

    public $facetField;



    public function getPayloadAsArray(): array
    {
        return [
            'query' => [
                'q' => $this->query,
                'fq' => $this->filterQuery,
                'rows' => $this->rows,
                'start' => $this->start,
                //'facet.field' => "[\"msl_subdomain\"]"
            ]
        ];
    }

    public function getResponseClass(): string
    {
        return $this->responseClass;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

}