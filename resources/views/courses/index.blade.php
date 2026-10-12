@extends('layouts.app')

@section('title', 'Data Mata Kuliah')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Mata Kuliah</h2>
    @can('admin')
    <a href="{{ route('courses.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Mata Kuliah
    </a>
    @endcan
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Kategori</th>
            <th>Jurusan</th>
            <th>Tags</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($courses as $i => $course)
        <tr>
            <td>{{ $courses->firstItem() + $i }}</td>
            <td><span class="badge bg-secondary">{{ $course->code }}</span></td>
            <td>{{ $course->name }}</td>
            <td>{{ $course->credits }}</td>
            <td>{{ $course->category->name }}</td>
            <td>{{ $course->department->name }}</td>
            <td>
                @foreach($course->tags as $tag)
                <span class="badge bg-info text-dark">{{ $tag->name }}</span>
                @endforeach
            </td>
            <td>
                <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-info">
                    <i class="bi bi-eye"></i> Detail
                </a>
                @can('admin')
                <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus? Jadwal, tugas, KRS, dan nilai mata kuliah ini ikut terhapus.')">
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
            <td colspan="8" class="text-center">Belum ada data.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $courses->links() }}
@endsection