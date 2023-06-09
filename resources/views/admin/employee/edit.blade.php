@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Employee</h4>
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
                    <form class="forms-sample" action="{{ route('dashboard.employee.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('put')
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP Employee"
                                value="{{ $employee->nip }}">
                        </div>
                        <div class="form-group">
                            <label for="nama_pegawai">Nama Pegawai</label>
                            <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" placeholder="Nama Pegawai"
                                value="{{ $employee->nama_pegawai }}" required>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="js-example-basic-single w-100" name="role" id="role" required>
                                <option value="admin" {{ $employee->role == 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>
                                <option value="superadmin" {{ $employee->role == 'superadmin' ? 'selected' : '' }}>
                                    Super Admin
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input autocomplete="new-email" type="email" class="form-control" name="email" id="email" placeholder="email" required value="{{ $employee->email }}">
                        </div>
                        <div class="form-group">
                            <label for="password-baru">Password Baru (Jika tidak ingin merubah password silahkan dikosongi)</label>
                            <input autocomplete="new-password" type="password" class="form-control" name="password-baru" id="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" href="employee">Submit</button>
                        <a class="btn btn-light" href="{{ route('dashboard.employee.index') }}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
