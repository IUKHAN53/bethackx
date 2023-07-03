<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->where('id', '!=', auth()->id());

        // Perform search if a search term is provided
        $search = $request->input('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }
        $users = $query->paginate(20);
        // Append the search term to the pagination links
        if ($search) {
            $users->appends(['search' => $search]);
        }
        return view('superadmin.users.index', compact('users'));
    }

    public function create()
    {
        return view('superadmin.users.create')->with([
            'companies' => Company::query()->pluck('name', 'id')->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        User::create($request->all());

        return redirect()->route('super-admin.users.index')->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('superadmin.users.show', compact('user'));
    }

    public function edit($id)
    {
        return view('superadmin.users.edit')
            ->with([
                'companies' => Company::query()->pluck('name', 'id')->toArray(),
                'user' => User::findOrFail($id),
            ]);;
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // Validate and update the user
        // Example: Assume the validation and updating logic is implemented
        $user->update($request->all());

        return redirect()->route('super-admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->subscriptions()->delete();
        $user->delete();
        return redirect()->route('super-admin.users.index')->with('success', 'User deleted successfully');
    }
}
