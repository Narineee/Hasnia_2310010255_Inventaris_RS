@extends('layouts.auth')

@section('content')
<div style="
    min-height:100vh;
    background: linear-gradient(180deg, #1a3f7a, #000);
    display:flex;
    align-items:center;
    justify-content:center;
">

    <div class="col-md-4">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">
                <h4 class="text-center mb-3 fw-bold" style="color:#1a3f7a;">
                    Sistem Inventaris Rumah Sakit
                </h4>
                <p class="text-center text-muted mb-4">
                    Silahkan Masukkan Username
                </p>

                @if(session('error'))
                    <div class="alert alert-danger text-center">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login.auth') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input 
                            type="text" 
                            name="username" 
                            class="form-control"
                            placeholder="Masukkan username"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control"
                            placeholder="Masukkan password"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
