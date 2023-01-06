@extends('masteradmin')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Agama</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @foreach ($agama['data'] as $all)
            <form action="{{ url('/agama/clientapi/proseseditagama81/'.$all['id']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_agama">Nama Agama</label>
                        <input type="text" class="form-control" id="nama_agama" placeholder="Masukkan Agama"
                            value="{{$all['nama_agama']}}" name="nama_agama">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-success w-100">Ganti Agama</button>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection