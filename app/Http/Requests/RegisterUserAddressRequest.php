<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserAddressRequest extends FormRequest
{
    public function rules()
    {
        return [
            /**
             * @param Model/UserAddress
             */
            "city" => [
                "required",
                "string"
            ],
            "street" => [
                "required",
                "string"
            ],
            "neighborhood" => [
                "required",
                "string"
            ],
            "state" => [
                "required",
                "string"
            ],
            "country" => [
                "required",
                "string"
            ],
            "number" => [
                "required",
                "integer"
            ],
        ];
    }
}
