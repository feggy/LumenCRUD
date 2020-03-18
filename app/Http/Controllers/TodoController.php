<?php

namespace App\Http\Controllers;

use App\ModelTodo;
use Illuminate\Http\Request;
use App\Response\ResponseSTD;

class TodoController extends Controller
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

    public function index()
    {
        $data = ModelTodo::all();
        if (sizeof($data) == 0) {
            return $this->responseSTD->error("Oops, data null", "");
        }

        return $this->responseSTD->success($data, "");
    }

    public function show($id)
    {
        $data = ModelTodo::where('id', $id)->get();
        if (sizeof($data) == 0) {
            return $this->responseSTD->error("Data Not Found", "404");
        }

        return $this->responseSTD->success($data, "");
    }

    public function create(Request $request)
    {
        $data = new ModelTodo();
        $data->activity = $request->input('activity');
        $data->description = $request->input('description');
        $data->save();

        return $this->responseSTD->success("berhasil tambah data", "");
    }

    public function update(Request $request, $id)
    {
        $data = ModelTodo::where('id', $id)->first();
        $data->activity = $request->input('activity');
        $data->description = $request->input('description');
        $data->save();

        return $this->responseSTD->success("berhasil update data", "");
    }

    public function delete($id)
    {
        $data = ModelTodo::where('id', $id)->first();
        $data->delete();

        return $this->responseSTD->success("Berhasil delete data", "");
    }
}
