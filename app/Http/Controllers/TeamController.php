<?php

namespace App\Http\Controllers;

use App\Teams;
use Exception;
use Illuminate\Http\Response;

class TeamController extends Controller
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

            $result['data'] = Teams::all();

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

}
