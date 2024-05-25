<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    //show
    public function show()
    {
        $company = Company::find(1);
        return response([
            'company' => $company,
            'message' => 'Retrieved successfully.',
            'status' => 'success'
        ], 200);
    }
}
