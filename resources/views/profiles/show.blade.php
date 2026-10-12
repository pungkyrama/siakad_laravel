@extends('layouts.app')

@section('title', 'Detail Profil')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detail Profil: {{ $profile->user->name }}</h2>
    <a href="{{ route('profiles.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center mb-3">
                @if($profile->avatar)
                <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar"
                    class="img-thumbnail rounded-circle" width="160" height="160" style="object-fit: cover;">
                @else
                <i class="bi bi-person-circle text-secondary" style="font-size: 8rem;"></i>
                @endif
            </div>
            <div class="col-md-9">
                <table class="table table-borderless">
                    {{-- Data dari tabel users (Relasi One-to-One, sisi belongsTo) --}}
                    <tr>
                        <th width="200">Nama</th>
                        <td>: <a href="{{ route('users.show', $profile->user) }}">{{ $profile->user->name }}</a></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: {{ $profile->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>: {{ ucfirst($profile->user->role) }}</td>
                    </tr>
                    {{-- Data dari tabel profiles --}}
                    <tr>
                        <th>No. HP</th>
                        <td>: {{ $profile->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>: {{ $profile->address ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>: {{ $profile->birth_date?->format('d M Y') ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection