@extends('layouts.master')

@section('title')
    Home
@endsection

@section('content')

    <form action="{{ url('presensi/keluarawal') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea name="catatan" id="" cols="30" rows="10" placeholder="ketikan alasan anda pulang lebih awal"></textarea>
        <input type="hidden" name="valueFoto" value="{{ $valueFoto }}">
        <input type="hidden" name="jam_masuk" value="{{$jam_masuk }}">
        <button type="submit">Simpan</button>
    </form>

@endsection
