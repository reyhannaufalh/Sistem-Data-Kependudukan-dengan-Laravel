@extends('masteradmin')

@section('content')
<div class="col-md-6">

    <!-- Profile Image -->
    <div class="card ">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Agama</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Agama</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agama as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->nama_agama }}</td>
                                    <td><a class="border-0 bg-danger rounded p-2"
                                            href="{{ url('/deleteagama81', $item->id) }}"><i
                                                class="fa-solid fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.card -->

</div>
<div class="col-md-6">
    <div class="card">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Masukkan Agama Baru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('/tambahagama81') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_agama">Nama Agama</label>
                        <input type="text" class="form-control" id="nama_agama" placeholder="Masukkan Agama"
                            name="nama_agama">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-success w-100">Tambah Agama</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection