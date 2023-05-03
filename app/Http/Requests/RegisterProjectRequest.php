<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterProjectRequest extends UserBaseRequest
{
    public function rules()
    {
        return [
            /**
             * @param Model/Project
             */
            "user_id" => [
                "required"
            ],
            "type" => [
                "required",
                "string"
            ],
            "properties" => [
                "required"
            ],
        ];
    }
}
