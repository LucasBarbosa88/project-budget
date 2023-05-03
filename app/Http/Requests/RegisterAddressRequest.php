<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAddressRequest extends UserBaseRequest
{
    public function rules()
    {
        return [
            /**
             * @param Model/Address
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
