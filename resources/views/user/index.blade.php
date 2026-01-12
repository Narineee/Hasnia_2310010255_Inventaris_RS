@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-primary mb-0">Manajemen User</h4>
                <small class="text-muted">Kelola akun admin & petugas</small>
            </div>
            <a href="{{ route('user.create') }}" class="btn btn-primary">
                <i class='bx bx-plus'></i> Tambah User
            </a>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                @if($user->role == 'admin')
                                    <span class="badge bg-danger">Admin</span>
                                @else
                                    <span class="badge bg-success">Petugas</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('user.edit', $user->id) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class='bx bx-edit'></i>
                                </a>

                                @if($user->username !== 'admin')
                                <form action="{{ route('user.destroy', $user->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada data user
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
