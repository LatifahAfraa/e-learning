@extends('admin.layouts.app')
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <center>
                           <h5 style="font-weight: 700;">Edit Parent</h5>
                        </center></br>

                        @if (session("error"))
                        <script>
                            Swal.fire(
                                'Gagal!',
                                "{{ session('error') }}",
                                'error'
                            )
                        </script>
                        @endif

                        {{-- @dd($parent->user) --}}

                        <form action="{{ route('admin.parent.update', $parent->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama"  class="form-control" value="{{ $parent->user->nama }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username"  class="form-control"  value="{{ $parent->user->username }}">
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email"  class="form-control" value="{{ $parent->user->email }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status_ortu" class="col-sm-2 col-form-label">Status Ortu</label>
                                <div class="col-sm-10">
                                    <select name="status_ortu" id="status_ortu" class="form-control">
                                            <option value="Orang Tua Kandung"  @if($parent->status_ortu == "Orang Tua Kandung") selected @endif >Orang Tua Kandung</option>
                                            <option value="Orang Tua Angkat"  @if($parent->status_ortu == "Orang Tua Angkat") selected @endif >Orang Tua Angkat</option>
                                            <option value="Wali"  @if($parent->status_ortu == "Wali") selected @endif >Wali</option>
                                        </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="verifikasi" class="col-sm-2 col-form-label">Verifikasi</label>
                                <div class="col-sm-10">
                                    <select name="verifikasi" class="form-control">
                                            <option value="Verifikasi" @if ($parent->verifikasi == "Verifikasi") selected @endif>Verifikasi</option>
                                            <option value="Tidak Diverifikasi" @if ($parent->verifikasi == "Tidak Diverifikasi") selected @endif>Tidak Diverifikasi</option>
                                        </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_hp"  class="form-control" value="{{ $parent->user->no_hp }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="foto_kk" class="col-sm-2 col-form-label">Foto KK</label>
                                <div class="col-sm-10">
                                    <img src="{{ url($parent->foto_kk) }}" width="150px">
                                    <input type="file" name="foto_kk"  class="form-control" accept="image/*">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea name="alamat" rows="4" cols="50" class="form-control">{{ $parent->user->alamat }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password"  class="form-control" placeholder="Masukan password baru jika ingin merubah password" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" name="simpan" class="btn btn-success form-control">Simpan</button>
                                </div>
                            </div>

                    </div>
                </div><!-- /.card -->
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection
