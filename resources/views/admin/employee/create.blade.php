@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Data Employee</h4>
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
                    <form class="forms-sample" action="{{ route('dashboard.employee.store') }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP Employee"
                                value="{{ old('nip') }}">
                        </div>
                        <div class="form-group">
                            <label for="nama_pegawai">Nama Pegawai</label>
                            <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" placeholder="Nama Pegawai"
                                value="{{ old('nama_pegawai') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input autocomplete="new-email" type="email" class="form-control" name="email" id="email" placeholder="email" required value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="password-baru">Password</label>
                            <input autocomplete="new-password" type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" href="employee">Submit</button>
                        <button class="btn btn-light" href="employee">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
