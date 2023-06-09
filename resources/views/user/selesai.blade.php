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
            {{-- <h2></h2> --}}
            <section>
                <div class="inner">
            <!-- SECTION 1 -->
                    <div class="image-holder">
                        <img src="images/BRONE.png" alt="" height="500px">
                    </div>
                    <div class="form-content">
                        <div class="form-header">
                            <h3>PEMINJAMAN & PENGAMBILAN IJAZAH</h3>
                        </div>
                        <center style="font-size: 22px">
                            Data telah selesai diunggah
                            <br>
                            silahkan tunggu konfirmasi admin
                            <br>
                            jika belum mendapatkan balasan admin dalam 3 hari
                            <br>
                            silahkan hubungi kontak di bawah ini
                            <br>
                            081234567890
                            <br>
                            <br>
                            <a href="{{ route('home') }}" style="padding: 10px; border-radius:7px;" class="btn btn-primary">Selesai</a>
                        </center>

                        {{-- <div class="form-holder"> --}}
                            {{-- <button class="search-nim btn btn-primary" type="submit">Cek NIM</button> --}}
                        {{-- </div> --}}
        </form>

    </div>
    </div>
    </form>
    </div>
    </section>

    <!-- JQUERY -->
    <script src="js/jquery-3.3.1.min.js"></script>

    <!-- JQUERY STEP -->
    <script src="js/jquery.steps.js"></script>
    <script src="js/main.js"></script>
    <!-- Template created and distributed by Colorlib -->




</body>

</html>
