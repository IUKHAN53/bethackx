<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyGames;
use App\Models\Games;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve all companies
        $companiesQuery = Company::query();

        // Apply search filter if a search term is provided
        $search = $request->input('search');
        if ($search) {
            $companiesQuery->where('name', 'like', '%' . $search . '%');
        }

        // Paginate the results
        $companies = $companiesQuery->paginate(20);

        // Append the search term to the pagination links
        if ($search) {
            $companies->appends(['search' => $search]);
        }

        // Return the companies index view with the paginated companies
        return view('superadmin.companies.index', compact('companies'));
    }


    public function create()
    {
        // Return the company create view
        return view('superadmin.companies.create')->with([
            'admins' => User::query()->where('is_super_admin', 0)->get(),
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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'primary_color' => 'required|string|max:255',
            'secondary_color' => 'required|string|max:255',
            'tertiary_color' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'admin_id' => 'required|numeric',
            'request_access_link' => 'nullable|string',
            'help_link' => 'nullable|string',
            'home_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'home_banner_ref_link' => 'nullable|string',
            'admin_tutorial_link' => 'nullable|string',
        ], $messages);

        // Create a new company
        $company = new Company;
        $company->name = $request->input('name');
        $company->slug = Str::slug($request->input('name'), '-');
        $company->primary_color = $request->input('primary_color');
        $company->secondary_color = $request->input('secondary_color');
        $company->tertiary_color = $request->input('tertiary_color');
        $company->buttons_color = $request->input('buttons_color');
        $company->notices_color = $request->input('notices_color');
        $company->is_active = $request->input('is_active');
        $company->admin_id = $request->input('admin_id');
        $company->request_access_link = $request->input('request_access_link');
        $company->help_link = $request->input('help_link');
        $company->home_banner_ref_link = $request->input('home_banner_ref_link');
        $company->admin_tutorial_link = $request->input('admin_tutorial_link');
        $company->plan_checkout_link = $request->input('plan_checkout_link');
        $company->save();

        User::query()->where('id', $request->input('admin_id'))->update(['company_id' => $company->id, 'is_admin' => 1]);

        // Upload logo image
        if ($request->logo) {
            $logo = $request->file('logo');
            $logoPath = $logo->storeAs('public', 'company-' . $company->id . '-logo-' . time() . '.' . $logo->getClientOriginalExtension());
            $company->logo = $logoPath;
        }
        if ($request->favicon) {
            // Upload favicon image
            $favicon = $request->file('favicon');
            $faviconPath = $favicon->storeAs('public', 'company-' . $company->id . '-favicon-' . time() . '.' . $favicon->getClientOriginalExtension());
            $company->favicon = $faviconPath;
        }
        // Upload home banner image
        $homeBanner = $request->file('home_banner');
        if ($homeBanner) {
            $homeBannerPath = $homeBanner->storeAs('public', 'company-' . $company->id . '-home-banner-' . time() . '.' . $homeBanner->getClientOriginalExtension());
            $company->home_banner = $homeBannerPath;
        }

        // Update the logo and favicon paths in the company record
        $company->save();

//        create games for the company
        foreach (Games::query()->get() as $game) {
            CompanyGames::create(
                [
                    'company_id' => $company->id,
                    'game_id' => $game->id,
                    'iframe_link' => $game->iframe_link,
                    'is_active' => $game->status,
                ]);
        }
//        create plans for the company
        Plan::create([
            'name' => 'Free',
            'description' => 'Free plan',
            'price' => 0,
            'status' => 1,
            'company_id' => $company->id,
        ]);
        Plan::create([
            'name' => 'Premium',
            'description' => 'Premium plan',
            'price' => 100,
            'status' => 1,
            'company_id' => $company->id,
        ]);

        // Redirect to the company index page or show a success message
        return redirect()->route('super-admin.companies.index')->with('success', 'Empresa criada com sucesso!');
    }

    public function edit($id)
    {
        // Find the company by ID
        $company = Company::findOrFail($id);
        $admins = User::query()->where('is_super_admin', 0)->get();

        // Return the company edit view with the found company
        return view('superadmin.companies.edit', compact('company', 'admins'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'alpha_dash', Rule::unique('companies', 'slug')->ignore($company->id)],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'primary_color' => 'nullable|string|max:255',
            'secondary_color' => 'nullable|string|max:255',
            'tertiary_color' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
            'admin_id' => 'required|integer',
            'request_access_link' => 'nullable|string',
            'help_link' => 'nullable|string',
            'home_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'home_banner_ref_link' => 'nullable|string',
            'admin_tutorial_link' => 'nullable|string',
            'buttons_color' => 'nullable|string',
            'notices_color' => 'nullable|string',
            'plan_checkout_link' => 'nullable|string',
        ]);

        // Update the company data
        $company->name = $validatedData['name'];
        $company->slug = $validatedData['slug'];
        $company->primary_color = $validatedData['primary_color'];
        $company->secondary_color = $validatedData['secondary_color'];
        $company->tertiary_color = $validatedData['tertiary_color'];
        $company->buttons_color = $validatedData['buttons_color'];
        $company->notices_color = $validatedData['notices_color'];
        $company->is_active = $validatedData['is_active'];

        $company->request_access_link = $validatedData['request_access_link'];
        $company->help_link = $validatedData['help_link'];
        $company->home_banner_ref_link = $validatedData['home_banner_ref_link'];
        $company->admin_tutorial_link = $validatedData['admin_tutorial_link'];
        $company->plan_checkout_link = $validatedData['plan_checkout_link'];

        if ($company->admin_id != $validatedData['admin_id']) {
            $p_admin = User::query()->where('id', $company->admin_id)->first();
            $p_admin->company_id = null;
            $p_admin->is_admin = 0;
            $p_admin->save();

            $company->admin_id = $validatedData['admin_id'];
            $n_admin = User::query()->where('id', $validatedData['admin_id'])->first();
            $n_admin->company_id = $company->id;
            $n_admin->is_admin = 1;
            $n_admin->save();
        }
        if ($request->logo && $company->logo != null && Storage::exists($company->logo)) {
            $linkPath = Storage::path($company->logo);
            if (file_exists($linkPath)) {
                unlink($linkPath);
            }
            Storage::delete($company->logo);
            $company->logo = null;
        }
        if ($request->favicon && $company->favicon != null && Storage::exists($company->favicon)) {
            $linkPath = Storage::path($company->favicon);
            if (file_exists($linkPath)) {
                unlink($linkPath);
            }
            Storage::delete($company->favicon);
            $company->favicon = null;
        }
        if ($request->home_banner && $company->home_banner != null && Storage::exists($company->home_banner)) {
            $linkPath = Storage::path($company->home_banner);
            if (file_exists($linkPath)) {
                unlink($linkPath);
            }
            Storage::delete($company->home_banner);
            $company->home_banner = null;
        }
        $company->save();

        // Handle logo file upload
        if ($request->logo) {
            $logo = $request->file('logo');
            $logoPath = $logo->storeAs('public', 'company-' . $company->id . '-logo-' . time() . '.' . $logo->getClientOriginalExtension());
            $company->logo = $logoPath;
        }

        // Handle favicon file upload
        if ($request->favicon) {
            $favicon = $request->file('favicon');
            $faviconPath = $favicon->storeAs('public', 'company-' . $company->id . '-favicon-' . time() . '.' . $favicon->getClientOriginalExtension());
            $company->favicon = $faviconPath;
        }

        // Handle home banner file upload
        if ($request->home_banner) {
            $homeBanner = $request->file('home_banner');
            $homeBannerPath = $homeBanner->storeAs('public', 'company-' . $company->id . '-home-banner-' . time() . '.' . $homeBanner->getClientOriginalExtension());
            $company->home_banner = $homeBannerPath;
        }

        // Save the updated company data
        $company->save();

        return redirect()->route('super-admin.companies.index')->with('success', 'Empresa atualizada com sucesso!');
    }


    public function show($id)
    {
        // Find the company by ID
        $company = Company::findOrFail($id);

        // Return the company show view with the found company
        return view('superadmin.companies.show', compact('company'));
    }


    public function destroy($id)
    {
        // Find the company by ID
        $company = Company::findOrFail($id);

//        Delete the company games
        CompanyGames::where('company_id', $company->id)->delete();

        // Delete the company
        $company->delete();

        // Redirect to the companies index route with a success message
        return redirect()->route('super-admin.companies.index')->with('success', 'Company deleted successfully');
    }
}

