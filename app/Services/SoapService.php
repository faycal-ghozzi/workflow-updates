<?php

namespace App\Services;

use SoapClient;
use Exception;
use Illuminate\Support\Facades\Log;

class SoapService
{
    private $soapClient;
    private $commonParams;

    public function __construct()
    {
        $this->soapClient = new SoapClient(env('SOAP_WSDL_URL'));
        $this->commonParams = [
            'WebRequestCommon' => [
                'userName' => env('SOAP_USERNAME'),
                'password' => env('SOAP_PASSWORD'),
                'company'  => env('SOAP_COMPANY')
            ]
        ];
    }

    public function buildParams($service, $specificParams = [])
    {
        $params = $this->commonParams;
        if($service === 'WSINFORMATIONGLOB'){
            $params['WSINFORMATIONSGLOBType'] = $specificParams;
        }elseif($service === 'WSLIMIT'){
            $params['LIMITEWSType'] = $specificParams;
        }else{
            $params[$service . 'Type'] = $specificParams;
        }
        return $params;
    }

    public function request($service, $params, $extractPath = null)
    {
        // set_time_limit(0);
        try {
            $response = $this->soapClient->$service($params);

            $responseArray = json_decode(json_encode($response), true);

            if (
                isset($responseArray['Status']['successIndicator']) &&
                $responseArray['Status']['successIndicator'] === 'T24Error'
            ) {
                Log::error("SOAP Error in {$service}: " . json_encode($responseArray['Status']['messages']));
                return [];
            }

            if (!$extractPath) {
                if($service === 'WSINFORMATIONGLOB'){
                    $service = 'WSINFORMATIONSGLOB';
                }
                if($service === 'WSLIMIT'){
                    $service = 'LIMITEWS';
                }
                $inner = $responseArray[$service . 'Type'] ?? [];
                $detail = $inner['g' . $service . 'DetailType']['m' . $service . 'DetailType'] ?? [];
                return $detail;
            }

            return data_get($responseArray, $extractPath, []);
        } catch (Exception $e) {
            Log::error('SOAP Exception: ' . $e->getMessage());
            return [];
        }
    }
}
