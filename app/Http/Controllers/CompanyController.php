<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    //show
    public function show($id)
    {
        $company = Company::find(1);
        return view('pages.company.show', compact('company'));
    }

    //edit
    public function edit($id)
    {
        $company = Company::find($id);
        return view('pages.company.edit', compact('company'));
    }

    //update
    public function update(Request $request, Company $company)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius_km' => 'required',
            'phone' => 'required',
            'tlp' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
        ]);

        //update
        $company->update($request->all());

        return redirect()->route('companies.show', $company->id)->with('success', 'Company updated successfully');
    }
}
