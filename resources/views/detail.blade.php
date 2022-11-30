@extends('template')
@section('main')
    <a href="/" class="btn btn-secondary">Kembali</a>
    <div class="row justify-content-center">
        <div class="card mb-5" style="width: 25rem;">
            <img src="{{ asset('storage/' . $buku->cover) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $buku->judul }}</h5>
                <p>terbitan {{ $buku->penerbit }}</p>
                <p class="card-text">{{ $buku->sinopsis }}</p>
            </div>
        </div>
    </div>
@endsection
