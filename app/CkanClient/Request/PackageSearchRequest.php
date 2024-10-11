<?php
namespace App\CkanClient\Request;

use App\CkanClient\Response\BaseResponse;
use App\CkanClient\Response\PackageSearchResponse;
use App\CkanClient\SolrUtils;

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

    public $filterQueries = [];

    public $rows;

    public $start;

    public $facetFields = [];



    public function getPayloadAsArray(): array
    {
        return [
            'query' => [
                'q' => $this->query,
                'fq' => $this->getFilterQueryQuery(),
                'rows' => $this->rows,
                'start' => $this->start,
                'facet.field' => $this->getFacetFieldQuery()
            ]
        ];
    }

    public function addFilterQuery($fieldName, $value)
    {
        $this->filterQueries[$fieldName][] = SolrUtils::escape($value);
    }

    private function getFilterQueryQuery()
    {
        if(count($this->filterQueries) > 0) {
            $parts = [];
            foreach($this->filterQueries as $key => $values) {
                foreach($values as $value) {
                    $parts[] = $key . ':' . $value;
                }
            }

            $return = implode(' AND ', $parts);

            return $return;
        }

        return '';
    }

    public function addFacetField($facetField)
    {
        $this->facetFields[] = $facetField;
    }

    public function loadFacetsFromConfig($type)
    {
        if($type = "data-publications") {
            $facets = config('ckan.facets.data-publications');
            foreach($facets as $key => $value) {
                $this->addFacetField($key);
            }
        }
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