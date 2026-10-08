@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')
<h2>Edit Tag: {{ $tag->name }}</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('tags.update', $tag) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Tag <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name" value="{{ old('name', $tag->name) }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                    id="slug" name="slug" value="{{ old('slug', $tag->slug) }}">
                <div class="form-text">Kosongkan untuk dibuat ulang otomatis dari nama tag.</div>
                @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('tags.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection