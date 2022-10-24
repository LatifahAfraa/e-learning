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
                           <h5 style="font-weight: 700;">Create Teacher</h5>
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

                        <form action="{{ route('admin.teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama"  class="form-control" value="{{ $teacher->user->nama }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nip" class="col-sm-2 col-form-label">Nip</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nip"  class="form-control" value="{{ $teacher->nip }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username"  class="form-control" value="{{ $teacher->user->username }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password"  class="form-control" value="{{ $teacher->user->password }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email"  class="form-control" value="{{ $teacher->user->email }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="jabatan"  class="form-control" value="{{ $teacher->jabatan }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mapel" class="col-sm-2 col-form-label">Mapel</label>
                                <div class="col-sm-10">
                                    <input type="text" name="jabatan"  class="form-control" value="{{ $teacher->mapel }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status_kepegawaian" class="col-sm-2 col-form-label">Status Kepegawaian</label>
                                <div class="col-sm-10">
                                    <select name="status_kepegawaian" id="status_kepegawaian" class="form-control">
                                            <option value="Pegawai Tetap" @if($teacher->status_Kepegawaian == "Pegawai Tetap") selected @endif>Pegawai Tetap</option>
                                            <option value="Pegawai Kontrak" @if($teacher->status_Kepegawaian == "Pegawai Kontrak") selected @endif>Pegawai Kontrak</option>
                                        </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_hp"  class="form-control" value="{{ $teacher->user->no_hp }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                    <img src="{{ url($teacher->foto) }}" width="150px">
                                    <input type="file" name="foto"  class="form-control" accept="image/*">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ttd" class="col-sm-2 col-form-label">ttd</label>
                                <div class="col-sm-10">
                                    <img src="{{ url($teacher->ttd) }}" width="150px">
                                    <input type="file" name="ttd"  class="form-control" accept="image/*">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea name="alamat" rows="4" cols="50" class="form-control">{{ $teacher->user->alamat }}</textarea>
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
