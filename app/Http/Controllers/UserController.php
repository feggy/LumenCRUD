<?php

namespace App\Http\Controllers;

use App\ModelUser;
use App\Response\ResponseSTD;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $responseSTD;

    public function __construct()
    {
        $this->responseSTD = new ResponseSTD;
    }

    public function register(Request $request)
    {
        $data = new ModelUser();
        $data->username = $request->input('username');
        $data->password = md5($request->input('password'));
        $data->email = $request->input('email');
        $data->save();

        return $this->responseSTD->success("Success add user", "");
    }
}
