@extends('layouts.superadmin-layout')

@section('content')
    <h1>Edit User</h1>

    <form action="{{ route('super-admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Add your form fields here -->
        <button type="submit">Update</button>
    </form>
@endsection
