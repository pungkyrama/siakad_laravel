@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Pengumuman</h2>
    {{-- @can dengan nama class -> memanggil AnnouncementPolicy@create --}}
    @can('create', App\Models\Announcement::class)
    <a href="{{ route('announcements.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Pengumuman
    </a>
    @endcan
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($announcements as $i => $announcement)
        <tr>
            <td>{{ $announcements->firstItem() + $i }}</td>
            <td>{{ $announcement->title }}</td>
            <td>{{ $announcement->user->name }}</td>
            <td>
                <span class="badge bg-{{ $announcement->is_published ? 'success' : 'secondary' }}">
                    {{ $announcement->is_published ? 'Published' : 'Draft' }}
                </span>
            </td>
            <td>{{ $announcement->created_at->format('d M Y') }}</td>
            <td>
                <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-sm btn-info">
                    <i class="bi bi-eye"></i> Detail
                </a>
                {{-- @can dengan objek model -> memanggil AnnouncementPolicy@update / @delete --}}
                @can('update', $announcement)
                <a href="{{ route('announcements.edit', $announcement) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                @endcan
                @can('delete', $announcement)
                <form action="{{ route('announcements.destroy', $announcement) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
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
            <td colspan="6" class="text-center">Belum ada pengumuman.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $announcements->links() }}
@endsection