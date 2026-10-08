@extends('layouts.app')

@section('title', 'Data Tag')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Tag</h2>
    @can('admin')
    <a href="{{ route('tags.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Tag
    </a>
    @endcan
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Tag</th>
            <th>Slug</th>
            <th>Jumlah Mata Kuliah</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tags as $i => $tag)
        <tr>
            <td>{{ $tags->firstItem() + $i }}</td>
            <td><span class="badge bg-info text-dark">{{ $tag->name }}</span></td>
            <td><code>{{ $tag->slug }}</code></td>
            <td>{{ $tag->courses_count }}</td>
            <td>
                <a href="{{ route('tags.show', $tag) }}" class="btn btn-sm btn-info">
                    <i class="bi bi-eye"></i> Detail
                </a>
                @can('admin')
                <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus tag ini?')">
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
            <td colspan="5" class="text-center">Belum ada data.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $tags->links() }}
@endsection