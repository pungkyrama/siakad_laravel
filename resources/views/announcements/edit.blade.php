@extends('layouts.app')

@section('title', 'Edit Pengumuman')

@section('content')
<h2>Edit Pengumuman</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('announcements.update', $announcement) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                    id="title" name="title" value="{{ old('title', $announcement->title) }}" required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Isi Pengumuman <span class="text-danger">*</span></label>
                <textarea class="form-control @error('content') is-invalid @enderror"
                    id="content" name="content" rows="6" required>{{ old('content', $announcement->content) }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                {{-- Jika validasi gagal pakai old(), jika tidak pakai nilai dari database --}}
                <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1"
                    {{ (old() ? old('is_published') : $announcement->is_published) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_published">Publikasikan</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('announcements.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection