<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\JwtService;
use App\Services\Base64;
use App\Header;
use Carbon\Carbon;

class LoginController extends Controller
{
    protected $Jwt;

    public function __construct(JwtService $Jwt)
    {
        $this->Jwt = $Jwt; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // $header = array(
            //     "alg" => "HS256",
            //     "typ" => "JWT"
            // );
            // $headerjson = json_encode($header);
            // $base = $this->Jwt->encode($headerjson);
            // $libBase64 = base64_encode($headerjson);
            
            $header = $this->Jwt->HeaderJWT();
            $date = Carbon::now();
            $payload = array(
                "iss" => "Project Finish, From Hust",
                "iat"=> $date->toDateTimeString(),
                "exp"=> $date->addDays(29)->toDateTimeString(),
                "aud"=> "www.doan.com",
                "sub"=> "minhhieu97.hust@gmail.com",
                "GivenName"=> "Johnny",
                "Surname"=> "Rocket",
                "Email"=> "minhhieu97.hust@gmail.com"
            );

            $PayLoadJwt = $this->Jwt->PayloadJWT($payload);

            $string = [
                $header,
                $PayLoadJwt
            ];
            $data =  implode(".", $string);
            $signature = $this->Jwt->Signature($string);
            $Jwt = [
                $header,
                $PayLoadJwt,
                $signature
            ];
            $Jwt =  implode(".", $Jwt);
            $user = Auth::user();
            $user->jwt = $Jwt;
            $user->save();

            return $Jwt;
        } else {
            dd(2);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
