<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAddressRequest;
use App\Http\Requests\RegisterUserAddressRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\Models\Address\RegisterAddressService;
use App\Services\Models\User\RegisterUserAddressService;
use App\Services\Models\User\RegisterUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = RegisterUserRequest::validate($request);
        $dataAddress = RegisterAddressRequest::validate($request);
        $service = new RegisterUserService($data);

        if( !$user = $service->run() ) return response( null, 503 );
        if($user) {
            $dataAddress['user_id'] = $user->id;
            $this->storeAddress($dataAddress);
        }
        return response()->json( $user , 201 );
    }

    public function storeAddress($data) {
        $service = new RegisterAddressService($data);

        if( !$address = $service->run() ) return response( null, 503 );
        if($address) {
            $data['address_id'] = $address->id;
            $this->storeUserAddress($data);
        }
        return response()->json( $address , 201 );
    }

    public function storeUserAddress($data) {
        $service = new RegisterUserAddressService($data);

        if( !$userAddress = $service->run() ) return response( null, 503 );
        return response()->json( $userAddress , 201 );
    }
}
