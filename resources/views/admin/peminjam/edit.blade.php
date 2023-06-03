@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Peminjam</h4>
                    <form class="forms-sample" form action="{{ route('dashboard.person.update', $person->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="student_id" value="{{ $person->student_id }}">
                        <div class="form-group">
                            <label for="nama_peminjam">Nama Peminjam/Pengambil</label>
                            <input type="text" class="form-control" id="nama_peminjam" placeholder="Masukan nama peminjam..."
                                value="{{ $person->nama_peminjam }}" name="nama_peminjam">
                            @error('nama_peminjam')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No Telepon</label>
                            <input type="text" class="form-control" id="no_telp" placeholder="Masukan No Telepon"
                                name="no_telp" value="{{ $person->no_telp }}">
                            @error('no_telp')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Keperluan</label>
                            <select class="form-control" name="keperluan" aria-label="Default select example" style="margin-bottom: 10px">
                                <option value="pengambilan" {{ $person->keperluan == 'pengambilan' ? 'selected' : '' }}>Pengambilan</option>
                                <option value="peminjaman" {{ $person->keperluan == 'peminjaman' ? 'selected' : '' }}>Peminjaman</option>
                            </select>
                            @error('keperluan')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Hubungan</label>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="hubungan"
                                            id="keluarga_teman" value="Anggota Keluarga/Teman"
                                            @if ($person->hubungan == 'Anggota Keluarga/Teman') checked @endif>
                                            Anggota Keluarga/Teman
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="hubungan"
                                            id="yang_bersangkutan" value="Yang Bersangkutan"
                                            @if ($person->hubungan == 'Yang Bersangkutan') checked @endif>
                                            Yang Bersangkutan
                                    </label>
                                </div>
                            </div>
                            @error('hubungan')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Surat Kuasa?</label>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="surat_kuasa"
                                            id="surat_kuasa" value="1"
                                            @if ($person->surat_kuasa != NULL) checked @endif>
                                            Terdapat Surat Kuasa
                                    </label>
                                </div>
                            </div>
                            @error('hubungan')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ijazah_milik">Ijazah Milik Mahasiswa</label>
                            <input type="text" class="form-control" id="ijazah_milik"
                                value="{{ $person->student->nama }}" disabled>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Tanggal Pinjam</label>
                            <input type="date" class="form-control" name="tgl_pinjam"
                                value="{{ $person->tgl_pinjam }}" />
                            @error('tgl_pinjam')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Tanggal Kembali</label>
                            <input class="form-control" type="date" name="tgl_kembali"
                                value="{{ $person->tgl_kembali ?? '' }}" />
                                @error('tgl_kembali')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-center">
                                <img src="{{ Storage::url($person->image) }}"
                                    style="max-height: 500px">
                            </div>
                            <label for="image">Upload File</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" name="image" disabled
                                    placeholder="Upload File">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                            @error('image')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status"
                                            id="membershipRadios1" value="Tervalidasi"
                                            @if ($person->status == 'Tervalidasi') checked @endif>
                                        Tervalidasi
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status"
                                            id="membershipRadios2" value="Pending"
                                            @if ($person->status == 'Pending') checked @endif>
                                        Pending
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status"
                                            id="membershipRadios2" value="Tidak Tervalidasi"
                                            @if ($person->status == 'Tidak Tervalidasi') checked @endif>
                                        Tidak Tervalidasi
                                    </label>
                                </div>
                            </div>
                            @error('status')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Keterangan</label>
                            <textarea class="form-control" id="exampleTextarea1" rows="4" name="ket">{{ $person->ket }}</textarea>
                            @error('ket')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" href="student">Update</button>
                        <button class="btn btn-light" href="student">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
