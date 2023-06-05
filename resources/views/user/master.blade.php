<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Peminjaman & Pengambilan Ijazah | Universitas Brawijaya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="shortcut icon" href="images/UB.png" />
</head>

<body>
    <div class="wrapper">
        <form action="{{ route('home') }}" method="" id="wizard">
            <!-- SECTION 1 -->
            <h2></h2>
            <section>
                <div class="inner">
                    <div class="image-holder">
                        <img src="images/BRONE.png" alt="">
                    </div>
                    <div class="form-content">
                        <div class="form-header">
                            <h3>PEMINJAMAN & PENGAMBILAN IJAZAH</h3>
                        </div>
                        <p>Input Data Ijazah</p>
                        @if (session()->has('danger'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <p style="color: red; margin-top:20px">{!! session('danger') !!}</p>
                            </div>
                        @endif

                        <div class="form-holder">
                            <button class="search-nim btn btn-primary" type="submit">Cek NIM</button>
                        </div>

                        <div class="form-row">
                            <div class="form-holder w-100">
                                <input type="text" placeholder="Masukkan NIM" name="search" class="form-control"
                                    value="{{ request('search') }}" @error('nama') style="border-color: red;" @enderror>
                                    @error('nim')
                                        <label for="">{{ $message }}</label>
                                    @enderror
                            </div>
                        </div>
        </form>


        <form action="{{ route('firstStepPost') }}" method="post" id="wizard">
            @csrf
            <input type="hidden" name="student_id" value="{{ $studentData->id ?? '' }}">
            <input type="hidden" name="nim" value="{{ $studentData->nim ?? '' }}">
            <div class="form-row">
                <div class="form-holder w-100">
                        <input type="text" placeholder="Nomor Ijazah" class="form-control @error('no_ijazah') is-invalid @enderror" @disabled(true)
                            value="{{ $studentData->ijazah->no_ijazah ?? 'Nomor Ijazah Tidak/Belum Tersedia' }}" name="no_ijazah">
                </div>
                {{-- hidden input untuk kirim data --}}
                <input type="hidden" value="{{ $studentData->ijazah->no_ijazah ?? '' }}" name="no_ijazah">
            </div>
            <div class="form-row">
                <div class="form-holder">
                    <input type="text" placeholder="Nama" class="form-control"  @disabled(true)
                        value="{{ $studentData->nama ?? '' }}" name="nama">
                </div>
                {{-- hidden input untuk kirim data --}}
                <input type="hidden" value="{{ $studentData->nama ?? '' }}" name="nama">

                <div class="form-holder">
                    <input type="text" placeholder="Alamat" class="form-control @error('alamat') is-invalid @enderror" @disabled(true)
                        value="{{ $studentData->alamat ?? '' }}" name="alamat">
                </div>
                <input type="hidden" value="{{ $studentData->alamat ?? '' }}" name="alamat">
            </div>

            <div class="form-row">
                <div class="form-holder">
                    <input type="text" placeholder="Fakultas" class="form-control @error('fakultas') is-invalid @enderror" @disabled(true)
                        value="{{ $studentData->fakultas->fakultas ?? '' }}" name="fakultas">
                </div>
                <input type="hidden" value="{{ $studentData->fakultas->fakultas ?? '' }}" name="fakultas">

                <div class="form-holder">
                    <input type="text" placeholder="Program Studi" class="form-control @error('prodi') is-invalid @enderror" @disabled(true)
                        value="{{ $studentData->prodi->prodi ?? '' }}" name="prodi">
                </div>
                <input type="hidden" value="{{ $studentData->prodi->prodi ?? '' }}" name="prodi">
            </div>

            <br>

            <div class="form-group">
                <button class="search-nim btn btn-primary" type="submit">Selanjutnya</button>
                {{-- <button class="search-nim btn btn-primary" type="submit" {{ $studentData->ijazah->no_ijazah ?? 'disabled' }}>Selanjutnya</button> --}}
                {{-- <a class="next-step btn btn-primary font-size-h6" href="second">Selanjutnya</a> --}}
            </div>
    </div>
    </div>
    </section>
    </form>
    </div>

    <!-- JQUERY -->
    <script src="js/jquery-3.3.1.min.js"></script>

    <!-- JQUERY STEP -->
    <script src="js/jquery.steps.js"></script>
    <script src="js/main.js"></script>
    <!-- Template created and distributed by Colorlib -->




</body>

</html>
