<?php
namespace App\Services;

class JwtService 
{
	public function HeaderJWT()
    {
        $header = array(
            "alg" => "HS256",
            "typ" => "JWT"
        );
        $headerjson = json_encode($header);
        $JwtHeader = rtrim(strtr(base64_encode($headerjson), '+/', '-_'), '=');

        return $JwtHeader;
    }

    public function PayloadJWT($payload)
    {
        $payloadjson = json_encode($payload);
        $JwtPayload = rtrim(strtr(base64_encode($payloadjson), '+/', '-_'), '=');
        
        return $JwtPayload;
    }

    public function Signature($string)
    {
        $data =  implode(".", $string);
        $secret = 'nguyenminhhieu20151340';
        $sig = hash_hmac('sha256', $data, $secret);
        $JwtSig = rtrim(strtr(base64_encode($sig), '+/', '-_'), '=');

        return $JwtSig;
    }
}