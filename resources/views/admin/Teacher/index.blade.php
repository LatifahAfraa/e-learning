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
                                <h5 style="font-weight: 700;">List Teacher</h5>
                            </center></br>

                            <a href="{{ route('admin.teacher.create') }}" class="btn btn-primary float-right my-2">
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
                            <div class="table-responsive">
                                <table id="admin" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NIP</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>No Hp</th>
                                            <th>Mapel</th>
                                            <th>Alamat</th>
                                            <th>Jabatan</th>
                                            <th>Status Kepegawaian</th>
                                            <th>TTD</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($teacher as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->user->nama ?? '' }}</td>
                                                {{-- relasi di user model --}}
                                                <td>{{ $item->nip ?? '' }}</td>
                                                <td>{{ $item->user->username ?? '' }}</td>
                                                <td>{{ $item->user->email ?? '' }}</td>
                                                <td>{{ $item->user->no_hp ?? '' }}</td>
                                                <td>{{ $item->mapel ?? '' }}</td>
                                                <td>{{ $item->user->alamat ?? '' }}</td>
                                                <td>{{ $item->jabatan ?? '' }}</td>
                                                <td>{{ $item->status_kepegawaian ?? '' }}</td>
                                                <td>
                                                    <img src="{{ asset($item->ttd) }}" width="50px">
                                                </td>
                                                <td>
                                                    <img src="{{ asset($item->foto) }}" width="50px">
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.teacher.edit', ['teacher' => $item->id]) }}"
                                                        class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="javascript:delete_data('{{ route('admin.teacher.delete', $item->id) }}')" class="btn btn-danger"><i class="fa fa-trash"></i>
                                                        Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.card -->
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
