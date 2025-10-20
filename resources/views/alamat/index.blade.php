@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Alamat</h2>

    @foreach ($alamat as $a)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px">
            <b>{{ $a->nama_penerima }}</b><br>
            {{ $a->no_hp }}<br>
            {{ $a->alamat }}, {{ $a->kota }}, {{ $a->provinsi }} - {{ $a->kode_pos }}
        </div>
    @endforeach

    <h4>Tambah Alamat Baru</h4>
    <form method="POST" action="{{ route('alamat.store') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="nama_penerima" placeholder="Nama Penerima" class="form-control" required><br>
            <input type="text" name="no_hp" placeholder="No HP" class="form-control" required><br>
            <textarea name="alamat" placeholder="Alamat Lengkap" class="form-control" required></textarea><br>
            <input type="text" name="kota" placeholder="Kota" class="form-control" required><br>
            <input type="text" name="provinsi" placeholder="Provinsi" class="form-control" required><br>
            <input type="text" name="kode_pos" placeholder="Kode Pos" class="form-control" required><br>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Alamat</button>
    </form>
</div>
@endsection
