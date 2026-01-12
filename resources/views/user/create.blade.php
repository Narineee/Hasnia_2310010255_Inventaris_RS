@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="container-fluid">

    <div class="row mb-4">
        <div class="col">
            <h4 class="fw-bold text-primary mb-0">Tambah User</h4>
            <small class="text-muted">Buat akun admin atau petugas</small>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class='bx bx-save'></i> Simpan
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
