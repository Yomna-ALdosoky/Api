<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $settings= Settings::find(1);
        if($settings){
            return ApiResponse::sendResponse(200, 'Settings Retrieved Successfully', new SettingResource($settings));
        }
        return ApiResponse::sendResponse(200, 'Settings Not Found', []);
        //return SettingResource::collection($settings);  لو كانت اكتر من داتا
    }
}
