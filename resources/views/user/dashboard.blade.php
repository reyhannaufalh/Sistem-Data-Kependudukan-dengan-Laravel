@extends('master')

@section('content')
<div class="col-md-6">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center mt-3 mb-2">
                <img class="profile-user-img img-fluid img-circle"
                    src="{{ isset($user['foto']) ? asset('foto_profil/'. $user['foto']) : asset('foto_profil/default.png') }}"
                    alt="User profile picture">
            </div>


            <h3 class="profile-username text-center mb-5 font-weight-bold">{{ $user['name'] }}</h3>

            <form action="{{ url('/ubahfotoprofil81') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $user['id'] }}" id="">
                <div class="input-group">
                    <!-- /btn-group -->
                    <div class="form-group w-100">
                        <div class="input-group">
                            <input name="foto" type="file" class="border p-1 w-75" id="image">
                            <button type="submit" class="btn btn-primary w-25 text-sm" name="kirim">Ubah Foto
                                Profil</button>
                        </div>
                    </div>
                </div>
            </form>

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{ $user['email'] }}</a>
                </li>
            </ul>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center mt-3 mb-4">
                <img class="w-50 h-25 rounded"
                    src="{{ isset($user['foto_ktp']) ? asset('foto_ktp/'. $user['foto_ktp']) : asset('foto_ktp/default_ktp.png') }}"
                    alt="User profile picture">
            </div>

            <form action="{{ url('/ubahfotoktp81') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $user['id'] }}" id="">
                <div class="input-group">
                    <!-- /btn-group -->
                    <div class="form-group w-100">
                        <div class="input-group">
                            <input name="foto_ktp" type="file" class="border p-1 w-75" id="image">
                            <button type="submit" class="btn btn-primary w-25" name="kirim">Ubah Foto KTP</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
<div class="col-md-6">
    <div class="card card-primary card-outline">
        <form action="{{ url('/ubahdatauser81') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $user['id'] }}" id="">
            <div class="card-body">
                <!-- <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Masukkan nama lengkap"
                        value="{{ $user['name'] }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="text" class="form-control" id="email" placeholder="Masukkan email"
                        value="{{ $user['email'] }}">
                </div> -->
                <div class="form-group">
                    <label for="alamat">Alamat Rumah</label>
                    <input name="alamat" type="text" class="form-control" id="alamat"
                        placeholder="Masukkan alamat rumah" value="{{ $user['alamat'] }}">
                </div>

                <div class="form-group">
                    <label for="tempat_lahir">Tempat Kelahiran</label>
                    <input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir"
                        placeholder="Masukkan tempat kelahiran" value="{{ $user['tempat_lahir'] }}">
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="d-block w-100 px-2 py-1 rounded"
                        value="{{ $user['tanggal_lahir'] }}">
                </div>

                <div class="form-group">
                    <label>Agama</label>

                    <select name="id_agama" id="" class="form-control select2">
                        @foreach ($agama as $a)
                        <option value="{{ $a['id'] }}" @if ($a['id']==$user['id_agama']) selected @endif>
                            {{ $a['nama_agama'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary px-5 col-12" name="submit-data">Update
                    Profil</button>
            </div>
        </form>
    </div>
    <div class="card card-primary card-outline">
        <form action="{{ url('/ubahpassword81') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $user['id'] }}" id="">
            <div class="card-body">
                <label for="">Password Lama</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Masukkan Password Lama"
                        name="old_password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <label for="" class="">Password Baru</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Masukkan Password Baru" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary px-5 col-12" name="submit-data">Ubah Password</button>
            </div>
        </form>
    </div>

</div>

@endsection