<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        // Retrieve all plans
        $plans = Plan::all();

        // Return the plans index view with the retrieved plans
        return view('superadmin.plans.index', compact('plans'));
    }

    public function create()
    {
        // Return the plan create view
        return view('superadmin.plans.create')->with([
            'companies' => Company::query()->where('is_active', 1)->pluck('name', 'id')->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|in:0,1',
            'company_id' => 'required|exists:companies,id',
        ], [
            'name.required' => 'O campo Nome é obrigatório.',
            'description.required' => 'O campo Descrição é obrigatório.',
            'price.required' => 'O campo Preço é obrigatório.',
            'price.numeric' => 'O campo Preço deve ser um valor numérico.',
            'status.required' => 'O campo Status é obrigatório.',
            'status.in' => 'O campo Status deve ser 0 (Inativo) ou 1 (Ativo).',
            'company_id.required' => 'O campo Empresa é obrigatório.',
            'company_id.exists' => 'A Empresa selecionada é inválida.',
        ]);

        Plan::create($validatedData);

        return redirect()->route('super-admin.plans.index')->with('success', 'Plano criado com sucesso.');

    }

    public function show($id)
    {
        // Find the plan by ID
        $plan = Plan::findOrFail($id);

        // Return the plan show view with the found plan
        return view('superadmin.plans.show', compact('plan'));
    }

    public function edit($id)
    {
        // Find the plan by ID
        $plan = Plan::findOrFail($id);

        // Return the plan edit view with the found plan
        return view('superadmin.plans.edit')->with([
            'plan' => $plan,
            'companies' => Company::query()->where('is_active', 1)->pluck('name', 'id')->toArray(),
        ]);;
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|in:0,1',
            'company_id' => 'required|exists:companies,id',
        ], [
            'name.required' => 'O campo Nome é obrigatório.',
            'description.required' => 'O campo Descrição é obrigatório.',
            'price.required' => 'O campo Preço é obrigatório.',
            'price.numeric' => 'O campo Preço deve ser um valor numérico.',
            'status.required' => 'O campo Status é obrigatório.',
            'status.in' => 'O campo Status deve ser 0 (Inativo) ou 1 (Ativo).',
            'company_id.required' => 'O campo Empresa é obrigatório.',
            'company_id.exists' => 'A Empresa selecionada é inválida.',
        ]);

        $plan = Plan::findOrFail($id);
        $plan->update($validatedData);

        return redirect()->route('super-admin.plans.index')->with('success', 'Plano atualizado com sucesso.');
    }

    public function destroy($id)
    {
        // Find the plan by ID
        $plan = Plan::findOrFail($id);

        // Delete the plan
        $plan->delete();

        // Redirect to the plans index route with a success message
        return redirect()->route('super-admin.plans.index')->with('success', 'Plan deleted successfully');
    }
}
