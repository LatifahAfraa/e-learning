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
                           <h5 style="font-weight: 700;">Update Admin</h5>
                        </center></br>

                        <form action="{{ route("admin.admin.update", $admin->id) }}" method="POST">
                            @csrf
                            @method("put")
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" value="{{ $admin->user->nama }}" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" value="{{ $admin->user->username }}" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" value="{{ $admin->user->email }}" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status_admin" class="col-sm-2 col-form-label">Status Admin</label>
                                <div class="col-sm-10">
                                    <select name="status_admin" id="status_admin" class="form-control">
                                            <option value="Admin Jurusan" @if ( $admin->status_admin == "Admin Jurusan") selected @endif>Admin Jurusan</option>
                                            <option value="Admin TU" @if ( $admin->status_admin == "Admin TU") selected @endif>Admin TU</option>
                                            <option value="Admin Sekolah" @if ( $admin->status_admin == "Admin Sekolah") selected @endif>Admin Sekolah</option>
                                        </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_hp" value="{{ $admin->user->no_hp }}" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea name="alamat" rows="4" cols="50" class="form-control">{{ $admin->user->alamat }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
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
