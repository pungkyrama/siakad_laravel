@extends('layouts.app')

@section('title', 'Tambah Pengumuman')

@section('content')
<h2>Tambah Pengumuman Baru</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('announcements.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                    id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Isi Pengumuman <span class="text-danger">*</span></label>
                <textarea class="form-control @error('content') is-invalid @enderror"
                    id="content" name="content" rows="6" required>{{ old('content') }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1"
                    {{ old('is_published') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_published">Publikasikan sekarang</label>
                <div class="form-text">Jika tidak dicentang, pengumuman disimpan sebagai draft dan hanya terlihat oleh admin.</div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('announcements.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection