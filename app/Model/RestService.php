<?php
namespace App\Model;

use Exception;
use JsonSerializable;
use Monolog\Logger;

abstract class RestService implements JsonSerializable
{
    /**
     * @var resource $curl
     */
    private $curl;

    /**
     * @var string $baseUri
     */
    private $baseUri;

    /**
     * @var Logger $logger
     */
    private $logger;

    /**
     * @var string $user
     */
    private $user;

    /**
     * @var string $pass
     */
    private $pass;

    /**
     * @var array $headers
     */
    private $headers;

    /**
     * @var string $basicAuth
     */
    private $basicAuth;

    /**
     * RestService constructor.
     * @param Logger $logger
     * @param string $user
     * @param string $pass
     * @param string $baseUri
     */
    public function __construct(Logger $logger, string $user, string $pass, string $baseUri = 'https://www.delsud.com.ar/apis/ventas/'){
        $this->logger = $logger;
        $this->user = $user;
        $this->pass = $pass;
        $this->baseUri = $baseUri;
        $this->headers = array(
            'Content-Type:application/json',
            'Accept:application/json'
        );
        $this->basicAuth = "$user:$pass";
        return $this;
    }

    function __destruct()
    {
        if(!is_null($this->curl))
            curl_close($this->curl);
    }

    private function setCurlInstance(){
        if(!is_null($this->curl)){
            curl_reset($this->curl);
        }else{
            $this->curl  =  curl_init();
        }
        curl_setopt($this->curl,  CURLOPT_RETURNTRANSFER,  true);
        curl_setopt($this->curl,  CURLOPT_SSL_VERIFYPEER,  false);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->curl,  CURLOPT_VERBOSE,  FALSE);
        curl_setopt($this->curl, CURLINFO_HEADER_OUT, true);
        //curl_setopt($this->curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($this->curl, CURLOPT_USERPWD, $this->basicAuth);
        curl_setopt($this->curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    }

    public function post($uri){
        $this->setCurlInstance();
        curl_setopt($this->curl,  CURLOPT_POST,  true);
        curl_setopt($this->curl,  CURLOPT_POSTFIELDS,  json_encode($this));
        $response = $this->callCurl($this->baseUri.$uri,$this->headers);
        $httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        $this->logCurl(json_encode($this),$response);
        return $this->processResponse($response,$httpCode);
    }

    private function callCurl($url,$header = array()){
        curl_setopt($this->curl,  CURLOPT_URL,  $url);
        if(!empty($header)){
            curl_setopt($this->curl,  CURLOPT_HTTPHEADER,  $header);

        }
        $response = curl_exec($this->curl);
        return $response;
    }

    private function logCurl($data,$response){
        $ch = $this->curl;
        $this->logger->info("<---REQUEST--->");
        $this->logger->info($data);
        $this->logger->info("<---RESPONSE--->");
        $data = array(
            "URL"=>curl_getinfo($ch,CURLINFO_EFFECTIVE_URL),
            "HTTP_CODE"=>curl_getinfo($ch,CURLINFO_HTTP_CODE),
            "HEADER"=>curl_getinfo($ch,CURLINFO_HEADER_OUT),
            "RESPONSE"=>json_decode($response,true)
        );
        $this->logger->info(json_encode($data,JSON_UNESCAPED_SLASHES));
    }

    private function processResponse($response,$httpCode){
        if(strpos($httpCode,'2')===0){
            $response = json_decode($response,true);
        }else{
            $error = $this->processResponseError($response);
            throw new Exception($error,$httpCode);
        }
        return $response;
    }

    private function processResponseError($response){
        $responseError = json_decode($response,true);
        $error = 'An error has occurred';
        if(isset($responseError['Message']))
            $error = $responseError['Message'];
        return $error;
    }
}