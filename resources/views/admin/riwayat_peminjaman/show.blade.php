@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Riwayat Peminjaman</h4>
                    <form class="forms-sample" form action="" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="student_id" value="{{ $riwayat_peminjaman->student_id }}">
                        <div class="form-group">
                            <label for="nama_peminjam">Nama Peminjam/Pengambil</label>
                            <input type="text" class="form-control" id="nama_peminjam" placeholder="Masukan nama peminjam..."
                                value="{{ $riwayat_peminjaman->nama_peminjam }}" name="nama_peminjam" disabled>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No Telepon</label>
                            <input type="text" class="form-control" id="no_telp" placeholder="Masukan No Telepon"
                                name="no_telp" value="{{ $riwayat_peminjaman->no_telp }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="keperluan">Keperluan</label>
                            <input type="text" class="form-control" id="no_telp" placeholder="Masukan No Telepon"
                                name="no_telp" value="{{ $riwayat_peminjaman->keperluan }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="hubungan">Hubungan</label>
                            <input type="text" class="form-control" id="hubungan" placeholder="hubungan"
                                name="hubungan" value="{{ $riwayat_peminjaman->hubungan }}" disabled>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Surat Kuasa?</label>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="surat_kuasa"
                                            id="surat_kuasa" value="1"
                                            @if ($riwayat_peminjaman->surat_kuasa != NULL) checked @endif @disabled(true)>
                                            Terdapat Surat Kuasa
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ijazah_milik">Ijazah Milik Mahasiswa</label>
                            <input type="text" class="form-control" id="ijazah_milik"
                                value="{{ $riwayat_peminjaman->nama_mahasiswa }}" disabled>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Tanggal Pinjam</label>
                            <input type="date" class="form-control" name="tgl_pinjam"
                                value="{{ $riwayat_peminjaman->tgl_pinjam }}" disabled />
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Tanggal Kembali</label>
                            <input class="form-control" type="date" name="tgl_kembali"
                                value="{{ $riwayat_peminjaman->tgl_kembali ?? '' }}" disabled />
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label">Status</label>
                            <input type="text" class="form-control" id="ijazah_milik"
                                value="{{ $riwayat_peminjaman->status }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Keterangan</label>
                            <textarea class="form-control" id="exampleTextarea1" rows="4" name="ket" disabled>{{ $riwayat_peminjaman->ket }}</textarea>
                        </div>
                        {{-- <button type="submit" class="btn btn-primary mr-2" href="student">Update</button> --}}
                        <button class="btn btn-light" href="{{ route('riwayat-peminjaman') }}">Kembali</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
