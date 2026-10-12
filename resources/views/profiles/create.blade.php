@extends('layouts.app')

@section('title', 'Tambah Profil')

@section('content')
<h2>Tambah Profil Baru</h2>

<div class="card">
    <div class="card-body">
        {{-- enctype="multipart/form-data" WAJIB ada agar file avatar ikut terkirim --}}
        <form action="{{ route('profiles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                    @endforeach
                </select>
                <div class="form-text">Hanya user yang belum memiliki profil yang ditampilkan.</div>
                @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">No. HP</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                    id="phone" name="phone" value="{{ old('phone') }}" maxlength="20">
                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control @error('address') is-invalid @enderror"
                    id="address" name="address" rows="3">{{ old('address') }}</textarea>
                @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="birth_date" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                    id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="avatar" class="form-label">Foto Profil</label>
                <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                    id="avatar" name="avatar" accept="image/*">
                <div class="form-text">Format gambar (jpg, png, dll), maksimal 2 MB.</div>
                @error('avatar')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('profiles.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection