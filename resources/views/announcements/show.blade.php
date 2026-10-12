@extends('layouts.app')

@section('title', $announcement->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>{{ $announcement->title }}</h2>
    <a href="{{ route('announcements.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <span>
            <i class="bi bi-person"></i> {{ $announcement->user->name }}
            &middot; <i class="bi bi-calendar"></i> {{ $announcement->created_at->format('d M Y H:i') }}
        </span>
        <span class="badge bg-{{ $announcement->is_published ? 'success' : 'secondary' }}">
            {{ $announcement->is_published ? 'Published' : 'Draft' }}
        </span>
    </div>
    <div class="card-body">
        {{-- e() meng-escape HTML agar aman dari XSS, nl2br() mengubah baris baru menjadi <br> --}}
        <p class="card-text">{!! nl2br(e($announcement->content)) !!}</p>
    </div>
    @can('update', $announcement)
    <div class="card-footer">
        <a href="{{ route('announcements.edit', $announcement) }}" class="btn btn-sm btn-warning">
            <i class="bi bi-pencil"></i> Edit
        </a>
    </div>
    @endcan
</div>
@endsection