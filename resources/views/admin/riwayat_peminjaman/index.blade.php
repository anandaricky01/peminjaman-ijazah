@extends('layouts.main')
@section('content')
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h3 class="card-title">Riwayat Peminjam</h3>
                            <button id="export" class="btn btn-primary" onclick="exportTableToCSV('peminjaman-ijazah.csv')">
                                <i data-feather="table" class="fas fa-plus"></i> Excel
                            </button>
                            {{-- <a href="/student-add" id="plus" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                            </a> --}}
                            <div class="table-responsive">
                                @if(Session::has('status'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('message')}}
                                </div>
                                @endif
                              <table id="table1" class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Nama Peminjam</th>
                                    <th>Status</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Kembali</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayat_peminjaman as $data)
                                    <tr>
                                        <td class="font-weight-bold">{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $data->nama_peminjam }}</td>
                                        <td class="font-weight-light">
                                            @if ($data->status == 'Tervalidasi')
                                                <div class="badge badge-success">Tervalidasi</div>
                                            @elseif ($data->status == 'Pending')
                                                <div class="badge badge-warning">Pending</div>
                                            @else
                                                <div class="badge badge-danger">Tidak Tervalidasi</div>
                                            @endif
                                        </td>
                                        <td>{{ $data->tgl_pinjam }}</td>
                                        <td>{{ $data->tgl_kembali }}</td>
                                        <td>
                                            <a href="{{ route('riwayat-peminjaman.show', $data->id) }}" id="edit" class="badge badge-primary">
                                                <i data-feather="eye" class="text-white"></i>
                                            </a>
                                        </td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
