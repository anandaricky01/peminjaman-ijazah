@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Dashboard</h3>
                    <h4 class="font-weight-normal mb-0">Selamat datang kembali</h4>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                            <h5><span id="tanggalwaktu"></span></h5>
                            <script>
                                var tw = new Date();
                                if (tw.getTimezoneOffset() == 0)(a = tw.getTime() + (7 * 60 * 60 * 1000))
                                else(a = tw.getTime());
                                tw.setTime(a);
                                var tahun = tw.getFullYear();
                                var hari = tw.getDay();
                                var bulan = tw.getMonth();
                                var tanggal = tw.getDate();
                                var hariarray = new Array("Minggu,", "Senin,", "Selasa,", "Rabu,", "Kamis,", "Jum'at,", "Sabtu,");
                                var bulanarray = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                                    "Oktober", "November", "Desember");
                                document.getElementById("tanggalwaktu").innerHTML = hariarray[hari] + " " + tanggal + " " + bulanarray[bulan] +
                                    " " + tahun;
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card card-white">
                <div class="card-people mt-0">
                    <img src="images/dashboard/photo.svg" alt="people">
                    <div class="weather-info">
                        <div class="d-flex">
                            <div id="main">
                                <main>
                                    <div class="temp">
                                        <div class="label">
                                            <sup id="marker"></sup>
                                            <h1 id="name" class="font-weight-bold"></h1>
                                            <sub id="country"></sub>
                                        </div>

                                        <h1 id="temp"></h1>
                                        <span id="description"><i class="fas fa-cloud"></i> <span
                                                id="desc"></span></span>
                                    </div>
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin transparent">
            <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Jumlah Peminjam</p>
                            <h1>{{ $jumlah_peminjam }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4">Jumlah Tervalidasi</p>
                            <h1>{{ $jumlah_tervalidasi }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4">Jumlah Belum Tervalidasi</p>
                            <h1>{{ $jumlah_pending }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                        <div class="card-body">
                            <p class="mb-4">Jumlah Gagal Validasi</p>
                            <h1>{{ $jumlah_tak_tervalidasi }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Daftar Peminjam</p>
                    <button id="export" class="btn btn-primary" onclick="exportTableToCSV('peminjaman-ijazah.csv')">
                        <i data-feather="printer" class="fas fa-plus"></i>
                    </button>
                    {{-- <a href="student-add" id="plus" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                    </a> --}}
                    <div class="table-responsive">
                        @if (Session::has('status'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <table id="table1" class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Peminjam</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Kembali</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjam as $data)
                                    <tr>
                                        <td class="font-weight-bold">{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $data->id }}</td>
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
                                        <td>{{ $data->tgl_kembali ?? '-' }}</td>
                                        <td>
                                            <a href="/student/{{ $data->id }}/edit" id="edit"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="/student/{{ $data->id }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger" id="hapus"
                                                    onclick="return confirm('Apakah anda ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i></button>
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
@endsection
