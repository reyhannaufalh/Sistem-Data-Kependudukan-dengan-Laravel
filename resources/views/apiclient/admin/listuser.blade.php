@extends('masteradmin')

@section('content')
<div class="w-100 row mb-2">
    <div class="col-6">
        <h2 class="font-weight-bold">List User <span class="text-danger">API</span></h2>
    </div>
    <div class="col-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">List User</li>
        </ol>
    </div>
</div>
<div class="card col-12">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user['data'] as $item)
                <tr class="text-center">
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $item['name'] }}</td>

                    <td>
                        @if ($item['is_aktif'] == '1')
                        <form action="{{ url('/admin/clientapi/statusnonaktif81/'.$item['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="$item['is_aktif']" name="is_aktif">
                            <button type="submit" class="btn btn-danger w-100">Non Aktifkan</button>
                        </form>
                        @else
                        <form action="{{ url('/admin/clientapi/statusaktif81/'.$item['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="$item['is_aktif']" name="is_aktif">
                            <button type="submit" class="btn btn-success w-100">Aktifkan</button>
                        </form>
                        <!-- <a href="{{ url('/statusaktif81',$item['id']) }}"
                            class="border-0 bg-success rounded p-2 w-100">Aktifkan</a> -->
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('/admin/clientapi/detailuser81/'.$item['id']) }}"
                            class="border-0 bg-success rounded p-2 w-100">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection