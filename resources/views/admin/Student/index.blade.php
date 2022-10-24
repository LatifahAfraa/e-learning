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
                                <h5 style="font-weight: 700;">List Student</h5>
                            </center></br>

                            <a href="{{ route('admin.student.create') }}" class="btn btn-primary float-right my-2">
                                <i class="fa fa-plus"></i> Tambah data
                            </a>
                            @if (session('success'))
                                <script>
                                    Swal.fire(
                                        'Berhasil!',
                                        "{{ session('success') }}",
                                        'success'
                                    )
                                </script>
                            @endif
                            <table id="admin" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nisn</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>No Hp</th>
                                        <th>Nama Ortu</th>
                                        <th>kelas</th>
                                        <th>Alamat</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($student as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->user->nama ?? '' }}</td>
                                            <td>{{ $item->nisn ?? '' }}</td>
                                            {{-- relasi di user model --}}
                                            <td>{{ $item->user->username ?? '' }}</td>
                                            <td>{{ $item->user->email ?? '' }}</td>
                                            <td>{{ $item->user->no_hp ?? '' }}</td>
                                            <td>{{ $item->parent->user->nama ?? '' }}</td>
                                            <td>{{ $item->kelas ?? '' }}</td>
                                            <td>{{ $item->user->alamat ?? '' }}</td>
                                            <td>
                                                <img src="{{ url($item->foto) }}" width="50px">
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.student.edit', $item->id) }}"
                                                    class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="javascript:delete_data('{{ route('admin.student.destroy', $item->id) }}')" class="btn btn-danger"><i class="fa fa-trash"></i>
                                                    Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.card -->
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
