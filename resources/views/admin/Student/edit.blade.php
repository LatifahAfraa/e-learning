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
                                <h5 style="font-weight: 700;">Edit Student</h5>
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

                            <form action="{{ route('admin.student.update', $student->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama" class="form-control"
                                            value="{{ $student->user->nama }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nisn" class="col-sm-2 col-form-label">Nisn</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nisn" class="form-control"
                                            value="{{ $student->nisn }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" class="form-control"
                                            value="{{ $student->user->username }}">
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $student->user->email }}">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="parent_id" class="col-sm-2 col-form-label">Nama Orang Tua</label>
                                    <div class="col-sm-10">
                                        <select name="parent_id" class="form-control">
                                            @foreach ($parents as $parent)
                                                <option value="{{ $parent->user->id }}" {{ $student->parent_id == $parent->id? "selected" : "" }}>{{ $parent->user->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="no_hp" class="form-control"
                                            value="{{ $student->user->no_hp }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="kelas" class="form-control"
                                            value="{{ $student->user->kelas }}">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                        <img src="{{ url($student->foto) }}" width="150px">
                                        <input type="file" name="foto" class="form-control" accept="image/*">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea name="alamat" rows="4" cols="50" class="form-control">{{ $student->user->alamat }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Masukan password baru jika ingin merubah password">
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
