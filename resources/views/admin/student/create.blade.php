@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Data Mahasiswa</h4>
                    @if(session()->has('danger'))
                        <div class="alert alert-success" role="alert">
                            {!!session('message')!!}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="forms-sample" action="{{ route('dashboard.student.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="exampleInputNIM1">NIM</label>
                            <input type="text" class="form-control" name="nim" id="exampleInputNIM1" placeholder="NIM"
                                value="{{ old('nim') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Nama</label>
                            <input type="text" class="form-control" name="nama" id="exampleInputName1" placeholder="Nama"
                                value="{{ old('nama') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Fakultas</label>
                            <select class="js-example-basic-single w-100" id="mySelect" name="id_fakultas" required>
                                @if ($fakultas->count() > 0)
                                    @foreach ($fakultas as $fak)
                                        <option value="{{ $fak->id }}">{{ $fak->fakultas }}</option>
                                    @endforeach
                                @else
                                    <option value="">Pilih salah satu</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <select class="js-example-basic-single w-100" name="id_prodi" required>
                                @if ($prodi->count() > 0)
                                    @foreach ($prodi as $prod)
                                        <option value="{{ $prod->id }}">Fakultas : {{ $prod->fakultas->fakultas }} - Prodi : {{ $prod->prodi }}</option>
                                    @endforeach
                                @else
                                    <option value="">Pilih salah satu</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="js-example-basic-single w-100" name="gender" id="gender" required>
                                <option value="L">
                                    Laki-laki
                                </option>
                                <option value="P">
                                    Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity1">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="exampleInputCity1" placeholder="Alamat" required value="{{ old('alamat') }}">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" href="student">Submit</button>
                        <button class="btn btn-light" href="student">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
