<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::all();
        return view('superadmin.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $plans = Plan::all();
        $users = User::all();

        return view('superadmin.subscriptions.create', compact('plans', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:0,1',
//            'start_date' => 'nullable|date',
//            'end_date' => 'nullable|date|after:start_date',
        ]);

        $subscription = Subscription::create([
            'plan_id' => $request->input('plan_id'),
            'user_id' => $request->input('user_id'),
            'status' => $request->input('status'),
//            'start_date' => $request->input('start_date'),
//            'end_date' => $request->input('end_date'),
        ]);

        // Redirect or perform additional actions as needed
        return redirect()->route('super-admin.subscriptions.index')
            ->with('success', 'Subscription created successfully.');
    }

    public function show(Subscription $subscription)
    {
        return view('superadmin.subscriptions.show', compact('subscription'));
    }

    public function edit($id)
    {
        $subscription = Subscription::findOrFail($id);
        $plans = Plan::all();
        $users = User::all();

        return view('superadmin.subscriptions.edit', compact('subscription', 'plans', 'users'));
    }

    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);

        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:0,1',
//            'start_date' => 'nullable|date',
//            'end_date' => 'nullable|date|after:start_date',
        ]);

        $subscription->update([
            'plan_id' => $request->input('plan_id'),
            'user_id' => $request->input('user_id'),
            'status' => $request->input('status'),
//            'start_date' => $request->input('start_date'),
//            'end_date' => $request->input('end_date'),
        ]);

        // Redirect or perform additional actions as needed
        return redirect()->route('super-admin.subscriptions.index')
            ->with('success', 'Subscription updated successfully.');
    }

    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        // Redirect or perform additional actions as needed
        return redirect()->route('super-admin.subscriptions.index')
            ->with('success', 'Subscription deleted successfully.');
    }
}
