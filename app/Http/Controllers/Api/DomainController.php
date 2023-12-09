<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\DomainResource;
use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $domain = Domain::all();
        if(count($domain) > 0){
            return ApiResponse::sendResponse(200, 'Domains Retrieved successafully', DomainResource::collection($domain));
        }
        return ApiResponse::sendResponse(200, 'Domain Are Empty', []);
    }
}
