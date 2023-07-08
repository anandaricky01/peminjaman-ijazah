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
                            <h3 class="card-title">Daftar Mahasiswa</h3>
                            <button id="export" class="btn btn-primary" onclick="exportTableToCSV('peminjaman-ijazah.csv')">
                                <i data-feather="table" class="fas fa-plus"></i> Excel
                            </button>
                            <a href="{{ route('import.student') }}" id="plus" class="btn btn-primary">
                                <i data-feather="plus" class="fas fa-plus"></i> Import
                            </a>
                            <a href="{{ route('dashboard.student.create') }}" id="plus" class="btn btn-primary">
                                <i data-feather="plus" class="fas fa-plus"></i> Manual
                            </a>
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
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Fakultas</th>
                                    <th>Program Studi</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student as $data)
                                    <tr>
                                        <td class="font-weight-bold">{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $data->nim }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->fakultas->fakultas }}</td>
                                        <td>{{ $data->prodi->prodi }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.student.edit', $data->id) }}" id="edit" class="btn btn-warning">
                                                <i data-feather="eye" class="text-white"></i>
                                            </a>
                                            <form action="{{ route('dashboard.student.delete', $data->id) }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger" id="hapus" onclick="return confirm('Apakah anda ingin menghapus data ini?')">
                                                    <i data-feather="trash-2" class="text-white"></i></button>
                                            </form>
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
