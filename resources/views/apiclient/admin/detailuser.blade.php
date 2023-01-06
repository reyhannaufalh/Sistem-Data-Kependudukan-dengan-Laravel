@extends('masteradmin')

@section('content')
<div class="col-md-12">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            @foreach ($user['data']['user'] as $item)
            <div class="text-center mt-3 mb-2">
                <img class="profile-user-img img-fluid img-circle"
                    src="{{ isset($item['foto']) ? asset('foto_profil/'. $item['foto']) : asset('foto_profil/default.png') }}"
                    alt="User profile picture">
            </div>
            <h3 class="profile-username text-center mb-5 font-weight-bold">{{ $item['name'] }}</h3>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Email</b> <a
                        class="float-right">{{ isset($item['email']) ? $item['email'] : 'Belum Terisi' }}</a>
                </li>
                @endforeach
                @foreach ($user['data']['detail'] as $detail)
                <li class="list-group-item">
                    <b>Alamat</b> <a
                        class="float-right">{{ isset($detail['alamat']) ? $detail['alamat'] : 'Belum Terisi' }}</a>
                </li>
                <li class="list-group-item">
                    <b>Tempat Lahir</b> <a
                        class="float-right">{{ isset($detail['tempat_lahir']) ? $detail['tempat_lahir'] : 'Belum Terisi' }}</a>
                </li>
                <li class="list-group-item">
                    <b>Tanggal Lahir</b> <a
                        class="float-right">{{ isset($detail['tanggal_lahir']) ? $detail['tanggal_lahir'] : 'Belum Terisi' }}</a>
                </li>
                <li class="list-group-item">
                    <b>Umur</b> <a
                        class="float-right">{{ isset($detail['umur']) ? $detail['umur'] : 'Belum Terisi' }}</a>
                </li>

                <li class="list-group-item">
                    <b>Foto KTP</b> <a class="float-right">
                        <img class="w-50 h-25 rounded float-right"
                            src="{{ isset($detail['foto_ktp']) ? asset('foto_ktp/'. $detail['foto_ktp']) : asset('foto_ktp/default_ktp.png') }}"
                            alt="user profile picture">
                    </a>
                </li>
                @endforeach
            </ul>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>

@endsection