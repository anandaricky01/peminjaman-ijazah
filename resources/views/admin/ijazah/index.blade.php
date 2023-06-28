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
                            <h3 class="card-title">Daftar Ijazah</h3>
                            <button id="export" class="btn btn-primary" onclick="exportTableToCSV('peminjaman-ijazah.csv')">
                                <i data-feather="table" class="fas fa-plus"></i> Excel
                            </button>
                            <a href="{{ route('dashboard.ijazah.create') }}" id="plus" class="btn btn-primary">
                                <i data-feather="plus" class="fas fa-plus"></i>
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
                                    <th>Nama Mahasiswa</th>
                                    <th>No Ijazah</th>
                                    <th>Status Ijazah</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ijazah as $data)
                                    <tr>
                                        <td class="font-weight-bold">{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $data->student->nama }}</td>
                                        <td>{{ $data->no_ijazah }}</td>
                                        <td class="font-weight-light">
                                            @if ($data->status_ijazah == 'available')
                                                <div class="badge badge-success">Available</div>
                                            @else
                                                <div class="badge badge-danger">Unavailable</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.ijazah.edit', $data->id) }}" id="edit" class="badge badge-warning">
                                                <i data-feather="eye" class="text-white"></i>
                                            </a>
                                            <form action="{{ route('dashboard.ijazah.delete', $data->id) }}" method="post" class="d-inline">
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
