<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    protected function failedValidation(Validator $validator)
    {
        if($this->is('api/*')) {
            $response = ApiResponse::sendResponse(422, 'Validation Errors',  $validator->messages()->all());
            throw new ValidationException($validator, $response);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'     => 'required',
            'slug'      => 'required',
            'text'      => 'required',
            'phone'     => 'required',
            'domain_id' => 'required|exists:domains,id'
        ];
    }
    public function attributes()
    {
       return [
        'title'     => 'Title',
        'slug'      => 'Slug',
        'text'      => 'Description',
        'phone'     => 'Phone',
        'domain_id' =>'Domain'
       ];
    }
}
