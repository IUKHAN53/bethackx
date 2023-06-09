<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
class CompanyController extends Controller
{
    public function index()
    {
        // Retrieve all companies
        $companies = Company::all();

        // Return the companies index view with the retrieved companies
        return view('super-admin.companies.index', compact('companies'));
    }

    public function create()
    {
        // Return the company create view
        return view('super-admin.companies.create');
    }

    public function store(Request $request)
    {
        // Validate and store the new company
        // Example: Assume the validation and storing logic is implemented
        Company::create($request->all());

        // Redirect to the companies index route with a success message
        return redirect()->route('super-admin.companies.index')->with('success', 'Company created successfully');
    }

    public function show($id)
    {
        // Find the company by ID
        $company = Company::findOrFail($id);

        // Return the company show view with the found company
        return view('super-admin.companies.show', compact('company'));
    }

    public function edit($id)
    {
        // Find the company by ID
        $company = Company::findOrFail($id);

        // Return the company edit view with the found company
        return view('super-admin.companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        // Find the company by ID
        $company = Company::findOrFail($id);

        // Validate and update the company
        // Example: Assume the validation and updating logic is implemented
        $company->update($request->all());

        // Redirect to the companies index route with a success message
        return redirect()->route('super-admin.companies.index')->with('success', 'Company updated successfully');
    }

    public function destroy($id)
    {
        // Find the company by ID
        $company = Company::findOrFail($id);

        // Delete the company
        $company->delete();

        // Redirect to the companies index route with a success message
        return redirect()->route('super-admin.companies.index')->with('success', 'Company deleted successfully');
    }
}

