<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        // Retrieve all plans
        $plans = Plan::all();

        // Return the plans index view with the retrieved plans
        return view('super-admin.plans.index', compact('plans'));
    }

    public function create()
    {
        // Return the plan create view
        return view('super-admin.plans.create');
    }

    public function store(Request $request)
    {
        // Validate and store the new plan
        // Example: Assume the validation and storing logic is implemented
        Plan::create($request->all());

        // Redirect to the plans index route with a success message
        return redirect()->route('super-admin.plans.index')->with('success', 'Plan created successfully');
    }

    public function show($id)
    {
        // Find the plan by ID
        $plan = Plan::findOrFail($id);

        // Return the plan show view with the found plan
        return view('super-admin.plans.show', compact('plan'));
    }

    public function edit($id)
    {
        // Find the plan by ID
        $plan = Plan::findOrFail($id);

        // Return the plan edit view with the found plan
        return view('super-admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        // Find the plan by ID
        $plan = Plan::findOrFail($id);

        // Validate and update the plan
        // Example: Assume the validation and updating logic is implemented
        $plan->update($request->all());

        // Redirect to the plans index route with a success message
        return redirect()->route('super-admin.plans.index')->with('success', 'Plan updated successfully');
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
