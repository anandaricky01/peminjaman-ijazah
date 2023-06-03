@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Mahasiswa</h4>
                    @if (session()->has('danger'))
                            <script>
                                alert("{{ session('danger') }}");
                            </script>
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
                    <form class="forms-sample" action="{{ route('dashboard.student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                        <div class="form-group">
                            <label for="exampleInputNIM1">NIM</label>
                            <input type="text" class="form-control" name="nim" id="exampleInputNIM1" placeholder="NIM"
                                value="{{ $student->nim }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Nama</label>
                            <input type="text" class="form-control" name="nama" id="exampleInputName1" placeholder="Nama"
                                value="{{ $student->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label>Fakultas</label>
                            <select class="js-example-basic-single w-100" id="mySelect" name="id_fakultas" required>
                                @if ($fakultas->count() > 0)
                                    @foreach ($fakultas as $fak)
                                        <option value="{{ $fak->id }}" {{ $student->id_fakultas == $fak->id ? 'selected' : '' }}>{{ $fak->fakultas }}</option>
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
                                        <option value="{{ $prod->id }}" {{ $student->id_prodi == $prod->id ? 'selected' : '' }}>Fakultas : {{ $prod->fakultas->fakultas }} - Prodi : {{ $prod->prodi }}</option>
                                    @endforeach
                                @else
                                    <option value="">Pilih salah satu</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="js-example-basic-single w-100" name="gender" id="gender" required>
                                <option value="L" {{ $student->gender == 'L' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="P" {{ $student->gender == 'P' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity1">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="exampleInputCity1" placeholder="Alamat" required value="{{ $student->alamat }}">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" href="student">Submit</button>
                        <a class="btn btn-light" href="{{ route('dashboard.student.index') }}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
