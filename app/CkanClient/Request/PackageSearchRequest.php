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

    public $facetFields = [];



    public function getPayloadAsArray(): array
    {
        return [
            'query' => [
                'q' => $this->query,
                'fq' => $this->filterQuery,
                'rows' => $this->rows,
                'start' => $this->start,
                'facet.field' => $this->getFacetFieldQuery()
            ]
        ];
    }

    public function addFacetField($facetField)
    {
        $this->facetFields[] = $facetField;
    }

    private function getFacetFieldQuery()
    {
        if(count($this->facetFields) > 0) {
            $return = '[';
            $parts = [];
            foreach($this->facetFields as $facetField) {
                $parts[] = '"' . $facetField . '"';
            }
            $return .= implode(',', $parts);
            $return .= ']';

            return $return;
        }

        return '[]';
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