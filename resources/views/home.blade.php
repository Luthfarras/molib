@extends('template')

@section('main')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($data as $buku)
        <div class="col-4">
            <div class="card mb-4">
                <img src="{{asset('storage/' .$buku->cover)}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$buku->judul}}</h5>
                    <p><sub>terbitan {{$buku->penerbit}}</sub></p>
                    <p>{{Str::limit($buku->sinopsis, 50)}} <a href="detail/{{$buku->id}}">Read More</a></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
