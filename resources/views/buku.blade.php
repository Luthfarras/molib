@extends('template')
@section('main')
    <div class="container">
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#add">
            Tambah +
          </button>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ISBN</th>
                    <th>Judul</th>
                    <th>Cover</th>
                    <th>Penerbit</th>
                    <th>Sinopsis</th>
                    @if (Auth::user()->role == 'admin')
                    <th>Status</th>
                    @endif
                    <th>Kategori</th>
                    <th>Editor</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $buku)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$buku->isbn}}</td>
                    <td>{{$buku->judul}}</td>
                    <td><img src="{{asset('storage/' .$buku->cover)}}" width="100px" alt="" srcset=""></td>
                    <td>{{$buku->penerbit}}</td>
                    <td>{{$buku->sinopsis}}</td>
                    @if (Auth::user()->role == 'admin')
                    <td>{{$buku->status}}</td>
                    @endif
                    <td>{{$buku->kategori->nama}}</td>
                    <td>{{$buku->user->name}}</td>
                    <td>
                        <button type="button" class="btn btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#edit{{$buku->id}}">
                            Edit
                          </button>
                        <a href="delbk/{{$buku->id}}" class="btn btn-danger mb-2">Hapus</a>
                        @if (Auth::user()->role == 'admin')
                        <a href="akses/{{$buku->id}}" class="btn btn-success mb-2">Kelola</a>
                        @endif
                    </td>
                </tr>
                <div class="modal fade" id="edit{{$buku->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Buku</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="{{route('buku.update', $buku->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="" class="form-label">ISBN</label>
                                <input type="number" class="form-control" name="isbn" required value="{{$buku->isbn}}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" required value="{{$buku->judul}}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Cover</label>
                                <input type="file" class="form-control" name="cover">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Penerbit</label>
                                <input type="text" class="form-control" name="penerbit" required value="{{$buku->penerbit}}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Sinopsis</label>
                                <textarea name="sinopsis" required class="form-control" id="" cols="30" rows="10">{{$buku->sinopsis}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Kategori</label>
                                <select name="kategori_id" class="form-select" id="" required>
                                    <option selected disabled>Pilih Kategori..</option>
                                    @foreach ($kategori as $k)
                                    <option value="{{$k->id}}" @if($k->id == $buku->kategori_id) @selected($k->id == $buku->kategori_id) @endif>{{$k->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Editor</label>
                                <input type="text" disabled class="form-control" value="{{Auth::user()->name}}">
                            </div>
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-success">Ubah</button>
                        </div>
                    </form>
                      </div>
                    </div>
                  </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Buku</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">ISBN</label>
                    <input type="number" class="form-control" name="isbn" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Cover</label>
                    <input type="file" class="form-control" name="cover" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" name="penerbit" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Sinopsis</label>
                    <textarea name="sinopsis" required class="form-control" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-select" id="" required>
                        <option selected disabled>Pilih Kategori..</option>
                        @foreach ($kategori as $k)
                        <option value="{{$k->id}}">{{$k->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Editor</label>
                    <input type="text" disabled class="form-control" value="{{Auth::user()->name}}">
                </div>
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
          </div>
        </div>
      </div>
@endsection
