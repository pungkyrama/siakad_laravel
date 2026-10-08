@extends('layouts.app')

@section('title', 'Detail Tag')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detail Tag: {{ $tag->name }}</h2>
    <a href="{{ route('tags.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">Nama Tag</th>
                <td>: {{ $tag->name }}</td>
            </tr>
            <tr>
                <th>Slug</th>
                <td>: <code>{{ $tag->slug }}</code></td>
            </tr>
        </table>
    </div>
</div>

{{-- Daftar Mata Kuliah yang memakai tag ini (Relasi Many-to-Many) --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Mata Kuliah dengan Tag Ini ({{ $tag->courses->count() }})</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Jurusan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tag->courses as $course)
                <tr>
                    <td>{{ $course->code }}</td>
                    <td><a href="{{ route('courses.show', $course) }}">{{ $course->name }}</a></td>
                    <td>{{ $course->credits }}</td>
                    <td>{{ $course->department->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada mata kuliah dengan tag ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection