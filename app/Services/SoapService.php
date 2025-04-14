<?php
namespace App\Services;

use SoapClient;
use Exception;
use Illuminate\Support\Facades\Log;

class SoapService
{
    private $soapClient;

    public function __construct()
    {
        $this->soapClient = new SoapClient(env('SOAP_WSDL_URL'));
    }

    public function request($service, $params)
    {
        try {
            Log::info('SOAP Request: ', $params);  // Log request params for debugging
            $response = $this->soapClient->$service($params);
            Log::info('SOAP Response: ', (array)$response);  // Log response for debugging

            $outerArray = (array)$response;
            $innerArray = (array)$outerArray[$service . 'Type'];
            $dataArray = (array)$innerArray['g' . $service . 'DetailType'];

            return (array)$dataArray['m' . $service . 'DetailType'];
        } catch (Exception $e) {
            Log::error('SOAP Error: ' . $e->getMessage());
            return [];
        }
    }
}