@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">

    <div class="row mb-4">
        <div class="col">
            <h4 class="fw-bold text-primary mb-0">Edit User</h4>
            <small class="text-muted">Perbarui data user</small>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username"
                           value="{{ $user->username }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Password <small class="text-muted">(Kosongkan jika tidak diubah)</small>
                    </label>
                    <input type="password" name="password"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                        <option value="petugas" {{ $user->role=='petugas'?'selected':'' }}>Petugas</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-warning">
                        <i class='bx bx-edit'></i> Update
                    </button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
                        <i class='bx bx-arrow-back'></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
