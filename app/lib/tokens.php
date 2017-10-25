<?php
namespace App\Lib;
use \Firebase\JWT\JWT;
define("API_SECRET_KEY","36347");
class Tokens
{
  public function encode($data){
    $time = time();
    $token = array(
        'iat' => $time, // Tiempo que inició el token
        'exp' => $time + (60*60), // Tiempo que expirará el token (+1 hora)
        'data' => $data
    );
    return JWT::encode($token, API_SECRET_KEY);
  }
  function decode($jwt){
    JWT::$leeway = 60;
    try{
        $decoded = JWT::decode($jwt, API_SECRET_KEY, array('HS256'));
    } catch (Exception $e) {
        return $bodyError = array('error' => $e->getMessage() );
    }
    return $decoded->data;
  }
}
