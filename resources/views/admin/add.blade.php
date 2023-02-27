@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Data Peminjam</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="forms-sample" action="students" method="POST" enctype="multipart/form-data">
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
                            <select class="js-example-basic-single w-100" name="id_fakultas" required>
                                <option value="">Pilih salah satu</option>
                                @foreach ($item as $data)
                                    <option value="{{ $data->id_fakultas }}">{{ $data['fakultas']['fakultas'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <select class="js-example-basic-single w-100" name="id_prodi" required>
                                <option value="">Pilih salah satu</option>
                                @foreach ($item as $data)
                                    <option value="{{ $data->id_prodi }}">{{ $data['prodi']['prodi'] }}</option>
                                @endforeach
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
                        <div class="form-group">
                            <label for="exampleInputName1">Nama Peminjam</label>
                            <input type="text" class="form-control" name="nama_peminjam" id="exampleInputName1" placeholder="Nama Peminjam" required value="{{ old('nama_peminjam') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputNomor2">Nomor Telepon Peminjam</label>
                            <input type="text" class="form-control" name="no_telp" id="exampleInputNomor2" placeholder="Nomor Telepon Peminjam" required value="{{ old('no_telp') }}">
                        </div>
                        <div class="form-group">
                            <label>Hubungan</label>
                            <select class="js-example-basic-single w-100" name="hubungan" required>
                                <option value="">Pilih salah satu</option>
                                <option value="Anggota keluarga / Teman">
                                    Anggota keluarga / Teman
                                </option>
                                <option value="Yang Bersangkutan">
                                    Yang Bersangkutan
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" required>Tanggal Pinjam</label>
                            <input type="date" class="form-control" name="tgl_pinjam" value="{{ old('tgl_pinjam') }}"/>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" required>Tanggal Kembali</label>
                            <input class="form-control" type="date" name="tgl_kembali" value="{{ old('tgl_kembali') }}"/>
                        </div>
                        <div class="form-group">
                            <label for="image">Upload File</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload File">
                                <span class="input-group-append" id="image" name="image">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-2">
                                <div class="form-check" required>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status"
                                            id="membershipRadios1" value="Tervalidasi">
                                        Tervalidasi
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status"
                                            id="membershipRadios2" value="Pending">
                                        Pending
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status"
                                            id="membershipRadios2" value="Tidak Tervalidasi">
                                        Tidak Tervalidasi
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Keterangan</label>
                            <textarea class="form-control" name="ket" id="exampleTextarea1" rows="4">{{ old('ket') }}</textarea>
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
