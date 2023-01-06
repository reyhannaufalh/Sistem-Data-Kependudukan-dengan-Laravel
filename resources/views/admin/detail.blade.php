@extends('masteradmin')

@section('content')
<div class="col-md-12">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center mt-3 mb-2">
                <img class="profile-user-img img-fluid img-circle"
                    src="{{ isset($user['foto']) ? asset('foto_profil/'. $user['foto']) : asset('foto_profil/default.png') }}"
                    alt="User profile picture">
            </div>

            <h3 class="profile-username text-center mb-5 font-weight-bold">{{ $user['name'] }}</h3>

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Email</b> <a
                        class="float-right">{{ isset($user['email']) ? $user['email'] : 'Belum Terisi' }}</a>
                </li>
                <li class="list-group-item">
                    <b>Alamat</b> <a
                        class="float-right">{{ isset($user['alamat']) ? $user['alamat'] : 'Belum Terisi' }}</a>
                </li>
                <li class="list-group-item">
                    <b>Tempat Lahir</b> <a
                        class="float-right">{{ isset($user['tempat_lahir']) ? $user['tempat_lahir'] : 'Belum Terisi' }}</a>
                </li>
                <li class="list-group-item">
                    <b>Tanggal Lahir</b> <a
                        class="float-right">{{ isset($user['tanggal_lahir']) ? $user['tanggal_lahir'] : 'Belum Terisi' }}</a>
                </li>
                <li class="list-group-item">
                    <b>Umur</b> <a class="float-right">{{ isset($user['umur']) ? $user['umur'] : 'Belum Terisi' }}</a>
                </li>
                <li class="list-group-item">
                    <b>Agama</b> <a
                        class="float-right">{{ isset($agama['nama_agama']) ? $agama['nama_agama'] : 'Belum Terisi' }}</a>
                </li>
                <li class="list-group-item">
                    <b>Foto KTP</b> <a class="float-right">
                        <img class="w-50 h-25 rounded float-right"
                            src="{{ isset($user['foto_ktp']) ? asset('foto_ktp/'. $user['foto_ktp']) : asset('foto_ktp/default_ktp.png') }}"
                            alt="User profile picture">
                    </a>
                </li>
            </ul>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>

@endsection