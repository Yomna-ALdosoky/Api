<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CitiesResource;
use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $cities= City::all();
        if(count($cities) > 0) {
            return ApiResponse::sendResponse(200, 'Cities Retrieved Successfully', CitiesResource::collection($cities));
        } 
        return ApiResponse::sendResponse(200, 'Cities Is Emty', null);
    }
}
