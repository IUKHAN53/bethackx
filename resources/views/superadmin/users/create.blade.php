@extends('layouts.superadmin-layout')

@section('content')
    <h1>Create User</h1>

    <form action="{{ route('super-admin.users.store') }}" method="POST">
        @csrf
        <!-- Add your form fields here -->
        <button type="submit">Create</button>
    </form>
@endsection
