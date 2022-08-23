<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request){
        $validated = Validator::make($request->all(), [
            'first_name' => 'required|max:60',
            'last_name' => 'required|max:60',
            'email_address' => 'required|max:100',
            'phone_number' => 'required|max:20',
            'country' => 'required|max:100',
            'county' => 'required|max:70',
            'sub_county' => 'required|max:70',
            'constituency' => 'required|max:80'
        ]);

        if($validated->fails()){
            return $this->response('2', 'Data Validation Failed', $validated->errors());
        }

        $user = new user;

        try{
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email_address = $request->email_address;
            $user->phone_number = $request->phone_number;
            $user->country = $request->country;
            $user->county = $request->county;
            $user->sub_county = $request->sub_county;
            $user->constituency = $request->constituency;
            $user->save();
        }catch(\Exception $exception){
            return $this->response('3', 'Query Failed', $exception->getMessage());
        }

        if($request->has('preferences')){
            $user->userPreferenceConnectA()->sync($request['preferences']);
        }

        return $this->response('1', 'Request Sent Successfully', $user);
    }

    public function response($code, $message, $data): JsonResponse
    {
        return response()->json($this->getResponse($code, $message, $data));
    }

    public function getResponse($code, $message, $data): array
    {
        return ['status' => ['code' => $code, 'message' => $message], 'data' => $data];
    }
}
