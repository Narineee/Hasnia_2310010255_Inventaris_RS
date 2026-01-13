@extends('layouts.app')

@section('content')
<h4>🔔 Notifikasi</h4>

@forelse($notifikasis as $notif)
<div class="card mb-2 {{ $notif->status_baca === 'belum dibaca' ? 'border-warning' : '' }}">
    <div class="card-body">
        <h6>
            {{ $notif->judul }}
            @if($notif->status_baca === 'belum dibaca')
                <span class="badge bg-warning">Baru</span>
            @endif
        </h6>

        <p>{{ $notif->pesan }}</p>
        <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>

        @if($notif->status_baca === 'belum dibaca')
        <form method="POST" action="{{ route('notifikasi.baca', $notif->id) }}">
            @csrf
            <button class="btn btn-sm btn-primary mt-2">Tandai dibaca</button>
        </form>
        @endif
    </div>
</div>
@empty
<p>Tidak ada notifikasi</p>
@endforelse
@endsection