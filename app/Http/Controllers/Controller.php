<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $request;
    public function __construct()
    {
        $this->request=app('request');
    }
    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validator = $this->getValidationFactory()
            ->make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()){
            return $validator->errors();
        }else{
            return false;
        }
    }
}
