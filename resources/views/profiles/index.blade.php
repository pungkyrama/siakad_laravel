@extends('layouts.app')

@section('title', 'Data Profil')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Profil Pengguna</h2>
    @can('admin')
    <a href="{{ route('profiles.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Profil
    </a>
    @endcan
</div>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama User</th>
            <th>Email</th>
            <th>No. HP</th>
            <th>Tanggal Lahir</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($profiles as $i => $profile)
        <tr>
            <td>{{ $profiles->firstItem() + $i }}</td>
            <td>
                @if($profile->avatar)
                <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar"
                    class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                @else
                <i class="bi bi-person-circle fs-3 text-secondary"></i>
                @endif
            </td>
            <td>{{ $profile->user->name }}</td>
            <td>{{ $profile->user->email }}</td>
            <td>{{ $profile->phone ?? '-' }}</td>
            <td>{{ $profile->birth_date?->format('d M Y') ?? '-' }}</td>
            <td>
                <a href="{{ route('profiles.show', $profile) }}" class="btn btn-sm btn-info">
                    <i class="bi bi-eye"></i> Detail
                </a>
                @can('admin')
                <a href="{{ route('profiles.edit', $profile) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('profiles.destroy', $profile) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus profil ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
                @endcan
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Belum ada data.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $profiles->links() }}
@endsection