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
                                <h5 style="font-weight: 700;">Create Admin</h5>
                            </center></br>

                            @if (session('error'))
                                <script>
                                    Swal.fire(
                                        'Gagal!',
                                        "{{ session('error') }}",
                                        'error'
                                    )
                                </script>
                            @endif

                            <form action="{{ route('admin.admin.store') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status_admin" class="col-sm-2 col-form-label">Status Admin</label>
                                    <div class="col-sm-10">
                                        <select name="status_admin" class="form-control">
                                            <option value="Admin Jurusan">Admin Jurusan</option>
                                            <option value="Admin TU">Admin TU</option>
                                            <option value="Admin Sekolah">Admin Sekolah</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="no_hp" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea name="alamat" rows="4" cols="50" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" name="simpan"
                                            class="btn btn-success form-control">Simpan</button>
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
