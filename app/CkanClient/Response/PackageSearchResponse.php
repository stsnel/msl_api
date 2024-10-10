<?php
namespace App\CkanClient\Response;

class PackageSearchResponse extends BaseResponse
{
    

    public function __construct($body, $responseCode) {
        parent::__construct($body, $responseCode);
    }
}