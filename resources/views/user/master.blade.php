

 <!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Peminjaman Ijazah | Universitas Brawijaya</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
		<link rel="shortcut icon" href="images/UB.png" />
	</head>
	<body>
		<div class="wrapper">
			<form action="" method="post" id="wizard">
				@csrf
        		<!-- SECTION 1 -->
                <h2></h2>
                <section>
                     <div class="inner">
						<div class="image-holder">
							<img src="images/BRONE.png" alt="">
						</div>
						<div class="form-content" >
							<div class="form-header">
								<h3>PEMINJAMAN IJAZAH</h3>
							</div>
							<p>Input Data Ijazah</p>

                            <div class="form-holder">
                                <button class="search-nim btn btn-primary" type="submit">Cek NIM</button>
                            </div>

							<div class="form-row">
								<div class="form-holder w-100">
									<input type="text" placeholder="Masukkan NIM" name="nim" class="form-control"
									value="{{ $studentData->nim ?? '' }}">
								</div>
							</div>
			</form>


            <form action="/second" method="post" id="wizard">
			@csrf
							<div class="form-row">
								<div class="form-holder">
									<input type="text" placeholder="Nama" class="form-control" @disabled(true) 
									value="{{ $studentData->nama ?? '' }}"
									name="nama">
							    </div>
								{{-- hidden input untuk kirim data --}}
								<input type="hidden" value="{{ $studentData->nama ?? '' }}" name="nama">

							    <div class="form-holder">
									<input type="text" placeholder="Alamat" class="form-control" @disabled(true)
									value="{{ $studentData->alamat ?? '' }}"
									name="alamat">
							    </div>
								<input type="hidden" value="{{ $studentData->alamat ?? '' }}" name="alamat">
						    </div>

							<div class="form-row">
								<div class="form-holder">
									<input type="text" placeholder="Fakultas" class="form-control" @disabled(true)
									value="{{ $studentData->fakultas->fakultas ?? '' }}"
									name="fakultas">
								</div>
								<input type="hidden" value="{{ $studentData->fakultas->fakultas ?? '' }}"
									name="fakultas">

								<div class="form-holder">
									<input type="text" placeholder="Program Studi" class="form-control" @disabled(true)
									value="{{ $studentData->prodi->prodi ?? '' }}"
									name="prodi">
								</div>
								<input type="hidden" value="{{ $studentData->prodi->prodi ?? '' }}"
									name="prodi">
							</div>

							<br>
							<div class="form-group">
								<button class="search-nim btn btn-primary" type="submit">Selanjutnya</button>
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
