<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function create(CustomerRequest $request)
    {
        try {
            if (isset($request->validator) && $request->validator->fails()) {
                throw new \Exception('validator error : '.$request->validator->errors(), 422);
            }

            $params = $request->validated();
            $newCustomer = Customer::create($params);
            return response()->json([
                'status' => 'ok',
                'new_customer' => $newCustomer
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function read(Customer $customer)
    {
        return response()->json([
            'status' => 'ok',
            'customer' => $customer
        ],200);
    }

    public function update(Customer $customer, CustomerRequest $request)
    {
        try {

            if (isset($request->validator) && $request->validator->fails()) {
                throw new \Exception('validator error : '.$request->validator->errors(), 422);
            }

            $params = $request->validated();
            $status = $customer->update($params);

            return response()->json([
                'status' => $status ? 'ok' : 'error',
                'customer' => $customer
            ],200);

        } catch (\Exception $e){

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function delete(Customer $customer)
    {
        $customer->delete();

        return response()->json([
            'status' => 'ok',
        ],200);
    }
}
