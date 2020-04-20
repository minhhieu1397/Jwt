<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Base64;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    protected $base64;

    public function __construct(Base64 $base64)
    {
        $this->base64 = $base64; 
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
        //
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
        $jwt = $request->input('jwt');
        $email = $request->input('email');
        $user = User::find(1);

        if($user->jwt = $jwt) {
            $data = explode('.', $jwt);
            $result = $this->base64->decode($data[1]);
            $payload = json_decode($result, true);
            $today = strtotime(Carbon::now());
            $exp = strtotime($payload['exp']);

            if ($today > $exp ) {
                dd(1);
            } else {
                $email = $request->input('email');
                dd($email);
            }
        } else {
            dd(22);
        }
        dd($dddd,  $today);
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
