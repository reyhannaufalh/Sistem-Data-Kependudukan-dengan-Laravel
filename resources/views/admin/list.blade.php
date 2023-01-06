@extends('masteradmin')

@section('content')
<div class="w-100 row mb-2">
    <div class="col-6">
        <h2 class="font-weight-bold">List User</h2>
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
                    <th>Alamat</th>
                    <th>Agama</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $item)
                <tr class="text-center">
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->detail->alamat }}</td>
                    <td>
                        <form action="{{ url('/ubahagama81') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->detail->id }}" id="">
                            <select name="id_agama" id="" class="form-control select2">
                                @foreach ($agama as $a)
                                <option value="{{ $a['id'] }}" @if ($a['id']==$item->detail->id_agama) selected @endif>
                                    {{ $a['nama_agama'] }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <select name="id_agama" class="form-control select2" style="width: 100%;">
                                <option value="1" {{ $item->detail->id_agama == 1 ? 'selected' : '' }}>Islam</option>
                                <option value="2" {{ $item->detail->id_agama == 2 ? 'selected' : '' }}>Kristen</option>
                                <option value="3" {{ $item->detail->id_agama == 3 ? 'selected' : '' }}>Katolik</option>
                                <option value="4" {{ $item->detail->id_agama == 4 ? 'selected' : '' }}>Buddha</option>
                                <option value="5" {{ $item->detail->id_agama == 5 ? 'selected' : '' }}>Hindu</option>
                            </select> -->
                            <button type="submit" class="border-0 bg-warning rounded p-2 w-100 mt-2" name="kirim">Ubah
                                Agama</button>
                        </form>
                    </td>
                    <td>
                        @if ($item->is_aktif == '1')
                        <a href="{{ url('/statusnonaktif81',$item->id) }}"
                            class="border-0 bg-danger rounded p-2 w-100">Nonaktifkan</a>
                        @else
                        <a href="{{ url('/statusaktif81',$item->id) }}"
                            class="border-0 bg-success rounded p-2 w-100">Aktifkan</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('/detail81',$item->id) }}"
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