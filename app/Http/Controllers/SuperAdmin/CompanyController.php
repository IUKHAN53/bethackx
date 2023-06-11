<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        // Retrieve all companies
        $companies = Company::all();

        // Return the companies index view with the retrieved companies
        return view('superadmin.companies.index', compact('companies'));
    }

    public function create()
    {
        // Return the company create view
        return view('superadmin.companies.create')->with([
            'admins' => User::query()->pluck('name', 'id')->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser uma string.',
            'max' => [
                'string' => 'O campo :attribute não pode ter mais que :max caracteres.',
                'numeric' => 'O campo :attribute não pode ser maior que :max.',
            ],
            'image' => 'O arquivo enviado para o campo :attribute deve ser uma imagem.',
            'mimes' => 'O arquivo enviado para o campo :attribute deve ter um dos formatos: :values.',
            'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
            'numeric' => 'O campo :attribute deve ser um número.',
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif',
            'favicon' => 'required|image|mimes:jpeg,png,jpg,gif',
            'primary_color' => 'required|string|max:255',
            'secondary_color' => 'required|string|max:255',
            'tertiary_color' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'admin_id' => 'required|numeric',
        ], $messages);

        // Create a new company
        $company = new Company;
        $company->name = $request->input('name');
        $company->primary_color = $request->input('primary_color');
        $company->secondary_color = $request->input('secondary_color');
        $company->tertiary_color = $request->input('tertiary_color');
        $company->is_active = $request->input('is_active');
        $company->admin_id = $request->input('admin_id');
        $company->save();

        User::query()->where('id', $request->input('admin_id'))->update(['company_id' => $company->id, 'is_admin' => true]);

        // Upload logo image
        $logo = $request->file('logo');
        $logoPath = $logo->storeAs('public/companies/' . $company->id, 'logo-' . time() . '.' . $logo->getClientOriginalExtension());

        // Upload favicon image
        $favicon = $request->file('favicon');
        $faviconPath = $favicon->storeAs('public/companies/' . $company->id, 'favicon-' . time() . '.' . $logo->getClientOriginalExtension());

        // Update the logo and favicon paths in the company record
        $company->logo = $logoPath;
        $company->favicon = $faviconPath;
        $company->save();

        // Redirect to the company index page or show a success message
        return redirect()->route('super-admin.companies.index')->with('success', 'Empresa criada com sucesso!');
    }

    public function show($id)
    {
        // Find the company by ID
        $company = Company::findOrFail($id);

        // Return the company show view with the found company
        return view('superadmin.companies.show', compact('company'));
    }

    public function edit($id)
    {
        // Find the company by ID
        $company = Company::findOrFail($id);
        $admins = User::query()->pluck('name', 'id')->toArray();

        // Return the company edit view with the found company
        return view('superadmin.companies.edit', compact('company', 'admins'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,gif',
            'favicon' => 'image|mimes:jpeg,png,jpg,gif',
            'primary_color' => 'nullable|string|max:255',
            'secondary_color' => 'nullable|string|max:255',
            'tertiary_color' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
            'admin_id' => 'required|integer',
        ]);

        // Update the company data
        $company->name = $validatedData['name'];
        $company->primary_color = $validatedData['primary_color'];
        $company->secondary_color = $validatedData['secondary_color'];
        $company->tertiary_color = $validatedData['tertiary_color'];
        $company->is_active = $validatedData['is_active'];
        $company->admin_id = $validatedData['admin_id'];

        if ($request->hasFile('logo') && Storage::exists($company->logo)) {
            $linkPath = Storage::path($company->logo);
            if (file_exists($linkPath)) {
                unlink($linkPath);
            }
            Storage::delete($company->logo);
            $company->logo = null;
        }
        if ($request->hasFile('favicon') && Storage::exists($company->favicon)) {
            $linkPath = Storage::path($company->favicon);
            if (file_exists($linkPath)) {
                unlink($linkPath);
            }
            Storage::delete($company->favicon);
            $company->favicon = null;
        }
        $company->save();
        // Handle logo file upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->storeAs('public/companies' . $company->id, 'logo-' . time() . '.' . $logo->getClientOriginalExtension());
            $company->logo = $logoPath;
        }

        // Handle favicon file upload
        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $faviconPath = $favicon->storeAs('public/companies' . $company->id, 'favicon-' . time() . '.' . $favicon->getClientOriginalExtension());
            $company->favicon = $faviconPath;
        }

        // Save the updated company data
        $company->save();

        return redirect()->route('super-admin.companies.index')->with('success', 'Empresa atualizada com sucesso!');
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
