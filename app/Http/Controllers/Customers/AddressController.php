<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreAddressRequest;
use App\Services\AddressService;
use Illuminate\Http\Response;


class AddressController extends Controller
{
    private $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function store(StoreAddressRequest $request){
        $this->addressService->save($request);

        return response()->json([
            'message' => 'success',
            'data' => []
        ], Response::HTTP_CREATED);
    }
}
