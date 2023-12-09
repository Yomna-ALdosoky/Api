<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Models\City;
use App\Models\Districte;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $district= Districte::where('city_id', $request->input('city'))->get();
        if(count($district) > 0) {
            return ApiResponse::sendResponse(200, 'Districts Retrieved Successfully', DistrictResource::collection($district));
        }
        return ApiResponse::sendResponse(200, 'District For This City is Emty', []);
    }
}
