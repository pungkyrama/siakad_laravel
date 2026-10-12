@extends('layouts.app')

@section('title', 'Data Submissions')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Submissions</h2>
    @can('admin')
    <a href="{{ route('submissions.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Submissions
    </a>
    @endcan
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Assignment</th>
            <th>Mahasiswa</th>
            <th>Submitted At</th>
            <th>Score</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($submissions as $submission)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $submission->assignment->title ?? '-' }}</td>
            <td>{{ $submission->student->user->name ?? '-' }}</td>
            <td>{{ $submission->submitted_at ? $submission->submitted_at->format('Y-m-d H:i') : '' }}</td>
            <td>{{ $submission->score }}</td>
            <td>
                <a href="{{ route('submissions.show', $submission->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                @can('admin')
                <a href="{{ route('submissions.edit', $submission->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('submissions.destroy', $submission->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i></button>
                </form>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $submissions->links() }}
@endsection