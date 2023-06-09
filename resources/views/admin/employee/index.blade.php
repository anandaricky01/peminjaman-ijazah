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
                            <h3 class="card-title">Daftar Employee</h3>
                            {{-- <button id="export" class="btn btn-primary" onclick="exportTableToCSV('peminjaman-ijazah.csv')">
                                <i data-feather="printer" class="fas fa-plus"></i>
                            </button> --}}
                            <a href="{{ route('dashboard.employee.create') }}" id="plus" class="btn btn-primary">
                                <i data-feather="plus" class="fas fa-plus"></i>
                            </a>
                            <div class="table-responsive">
                                @if(session()->has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{session('success')}}
                                </div>
                                @endif
                                @if(session()->has('danger'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('danger')}}
                                </div>
                                @endif
                              <table id="table1" class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama Pegawai</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employee as $data)
                                    <tr>
                                        <td class="font-weight-bold">{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $data->nip }}</td>
                                        <td>{{ $data->nama_pegawai }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.employee.edit', $data->id) }}" id="edit" class="btn btn-warning">
                                                <i data-feather="eye" class="text-white"></i>
                                            </a>
                                            <form action="{{ route('dashboard.employee.delete', $data->id) }}" method="post" class="d-inline">
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
