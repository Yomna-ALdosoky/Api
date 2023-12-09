<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdRequest;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class AdController extends Controller
{
    public function index() {
        $ads= Ad::latest()->paginate(1);

        if(count($ads) > 0){

            if($ads->total() > $ads->perPage()){
                $data = [
                    'records' => AdResource::collection($ads),
                    'Pagination Links' =>[
                        'Current Page' => $ads->currentPage(),
                        'Per Page'     => $ads->perPage(),
                        'Total'        => $ads->total(),
                        'Links'        => [
                            'first'  => $ads->url(1), //اللينك بتاع اول صفحه 
                            'last'   => $ads->url($ads->lastPage()),
                        ],
                    ],
                ];

            }else{
                $data= AdResource::collection($ads);
            }

            return ApiResponse::sendResponse(200, 'Ads Retrieved Successfully', $data);
        }
        return ApiResponse::sendResponse(200, 'No Ads Available', []);
    }
    public function latest(){
        $ads = Ad::latest()->take(2)->get();
        if (count($ads) > 0) {
            return ApiResponse::sendResponse(200, 'Latest Ads Retrieved Successfully', AdResource::collection($ads));
        }
        return ApiResponse::sendResponse(200, 'There Are On Latest Ads', []);
    }

    public function domain($domain_id){

        $ads = Ad::where('domain_id',  $domain_id)->latest()->get();

        if(count($ads) > 0) {
            return ApiResponse::sendResponse(200, 'Ads in the Domain Retreved Successfully', AdResource::collection($ads));
        }
        return ApiResponse::sendResponse(200, 'Empty', []);

    }
    
    public function search(Request $request){

        $word= $request->has('search') ? $request->input('search') : null; // كلمه البحث

        $ads= Ad::when($word != null, function($q) use ($word){
            $q->where('title', 'like', '%' . $word . '%');
        })->latest()->get();

        if(count($ads) > 0){
            return ApiResponse::sendResponse(200, 'Search Completed', AdResource::collection($ads));
        }
        return ApiResponse::sendResponse(200, 'No Matching Data', []);
    }
    
    public function create(AdRequest $request){
        $data= $request->validated(); // validation  علشان اجيب ال 
        $data['user_id'] = $request->user()->id; //علشان اربط الاعلان بالمستخدم
        $record = Ad::create($data);

        if($record){
            return ApiResponse::sendResponse(201, 'Your Ad Created Successfly', new AdResource($record));
        }
        
    }

    public function update(AdRequest $request, $adId){

        $ad= Ad::findOrFail($adId);

        if($ad->user_id!=$request->user()->id){
            return ApiResponse::sendResponse(403, 'You Aren\'t Allowed To Take This Action', []);
        }

        $data= $request->validated();
        $updating= $ad->update($data);
        if($updating){
             return ApiResponse::sendResponse(201, 'your ad updated successfully', new AdResource($ad));
        }
    }

    public function delete(Request $request, $adId) {

        $ad= Ad::findOrFail($adId);

        if($ad->user_id != $request->user()->id) {
            return ApiResponse::sendResponse(403, 'You Aren\'t Allowed To Take This Action', []);
        }
        $destroy= $ad->delete();
        if($destroy) {
            return ApiResponse::sendResponse(200, 'Ad Delete Successfully', []);
        }
        

       
    }

    public function myads(Request $request){
        $ads= Ad::where('user_id', $request->user()->id)->latest()->get();

        if(count($ads) > 0) {
            return ApiResponse::sendResponse(200, 'My Ads Retrived Seccessfully', AdResource::collection($ads));
        }
        return ApiResponse::sendResponse(200, 'You Don\'t Have Any Ads', []);
    }



}

