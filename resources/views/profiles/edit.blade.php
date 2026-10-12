@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<h2>Edit Profil: {{ $profile->user->name }}</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('profiles.update', $profile) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $profile->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                    @endforeach
                </select>
                @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">No. HP</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                    id="phone" name="phone" value="{{ old('phone', $profile->phone) }}" maxlength="20">
                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control @error('address') is-invalid @enderror"
                    id="address" name="address" rows="3">{{ old('address', $profile->address) }}</textarea>
                @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="birth_date" class="form-label">Tanggal Lahir</label>
                {{-- Input type="date" membutuhkan format Y-m-d --}}
                <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                    id="birth_date" name="birth_date"
                    value="{{ old('birth_date', $profile->birth_date?->format('Y-m-d')) }}">
                @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="avatar" class="form-label">Foto Profil</label>
                @if($profile->avatar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar saat ini"
                        class="img-thumbnail" width="100">
                </div>
                @endif
                <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                    id="avatar" name="avatar" accept="image/*">
                <div class="form-text">Kosongkan jika tidak ingin mengganti foto.</div>
                @error('avatar')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('profiles.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection