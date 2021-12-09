<?php

namespace App\Http\Controllers;

use App\Powers;

use Exception;
use Illuminate\Http\Response;

class PowerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $result = ['status' => 200];

        try {

            $result['data'] = Powers::all();

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

}
