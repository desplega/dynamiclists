<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiImportDynlistRequest;
use App\Http\Requests\ApiSearchDynlistRequest;
use Illuminate\Http\Request;

class DylistAPIController extends Controller
{
    public function import(ApiImportDynlistRequest $request)
    {
        return [
            'status' => 'OK1',
            'results' => [],
        ];
    }

    public function search(ApiSearchDynlistRequest $request)
    {
        return [
            'status' => 'OK2',
            'results' => [],
        ];
    }
}
