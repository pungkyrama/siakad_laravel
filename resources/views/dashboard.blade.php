@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h2>Dashboard</h2>
<p>Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Anda login sebagai <strong>{{ ucfirst(Auth::user()->role) }}</strong>.</p>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <h2>{{ $stats['users'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Mahasiswa</h5>
                <h2>{{ $stats['students'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Dosen</h5>
                <h2>{{ $stats['teachers'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Mata Kuliah</h5>
                <h2>{{ $stats['courses'] }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection