@extends('layouts.app')

@section('title', 'Data User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data User</h2>
    @can('admin')
    <a href="{{ route('users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah User
    </a>
    @endcan
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>No. HP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $i => $user)
        <tr>
            <td>{{ $users->firstItem() + $i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                    {{ ucfirst($user->role) }}
                </span>
            </td>
            {{-- Relasi One-to-One: $user->profile bisa null jika user belum punya profil --}}
            <td>{{ $user->profile?->phone ?? '-' }}</td>
            <td>
                <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info">
                    <i class="bi bi-eye"></i> Detail
                </a>
                @can('admin')
                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                {{-- Tombol hapus tidak ditampilkan untuk akun yang sedang login --}}
                @if($user->id !== auth()->id())
                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus? Profil, data dosen/mahasiswa, dan pengumuman user ini ikut terhapus.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
                @endif
                @endcan
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada data.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $users->links() }}
@endsection