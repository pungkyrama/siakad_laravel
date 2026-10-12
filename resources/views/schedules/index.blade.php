@extends('layouts.app')

@section('title', 'Jadwal Perkuliahan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Jadwal Perkuliahan</h2>
    @can('admin')
    <a href="{{ route('schedules.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Jadwal
    </a>
    @endcan
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Mata Kuliah</th>
            <th>Dosen</th>
            <th>Ruangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($schedules as $i => $schedule)
        <tr>
            <td>{{ $schedules->firstItem() + $i }}</td>
            <td>{{ $schedule->day }}</td>
            {{-- Kolom TIME tersimpan sebagai "08:00:00", ambil 5 karakter pertama -> "08:00" --}}
            <td>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</td>
            <td>{{ $schedule->course->name }}</td>
            <td>{{ $schedule->teacher->user->name }}</td>
            <td>{{ $schedule->classroom->name }} ({{ $schedule->classroom->building }})</td>
            <td>
                <a href="{{ route('schedules.show', $schedule) }}" class="btn btn-sm btn-info">
                    <i class="bi bi-eye"></i> Detail
                </a>
                @can('admin')
                <a href="{{ route('schedules.edit', $schedule) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
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
            <td colspan="7" class="text-center">Belum ada data.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $schedules->links() }}
@endsection