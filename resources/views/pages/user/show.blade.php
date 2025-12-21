@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Detail User</h2>

    <div class="card shadow-sm">
        <div class="card-body text-center">
            <img src="{{ $user->profile_picture
                        ? asset('storage/uploads/profile/'.$user->profile_picture)
                        : asset('assets-admin/images/default-profile.png') }}"
                 alt="Profile Picture" class="img-fluid rounded-circle mb-3" width="150">

            <h4>{{ $user->name }}</h4>
            <p>Email: {{ $user->email }}</p>
            <p>Role: {{ ucfirst($user->role) }}</p>

            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning mt-2">Edit</a>
            <a href="{{ route('users.index') }}" class="btn btn-secondary mt-2">Kembali</a>
        </div>
    </div>
</div>
@endsection
