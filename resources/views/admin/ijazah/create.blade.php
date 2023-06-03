@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Data Ijazah</h4>
                    <form class="forms-sample" action="{{ route('dashboard.ijazah.store') }}" method="POST">
                        @if (session()->has('danger'))
                            <script>
                                alert("{{ session('danger') }}");
                            </script>
                        @endif
                    @csrf
                        <div class="form-group">
                            <label for="exampleInputNIM1">Mahasiswa</label>
                            <select class="form-control" id="mySelect" class="form-select" aria-label="Default select example" name="student_id">
                                @if($students->count() > 0)
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->nama }} - {{ $student->nim }}</option>
                                    @endforeach
                                @else
                                    <option selected disabled>Belum ada mahasiswa</option>
                                @endif
                            </select>

                            <input class="form-control" id="searchInput" type="text" placeholder="Cari nama atau nim mahasiswa">
                        </div>
                        <div class="form-group">
                            <label>Nomor Ijazah</label>
                            <input type="text" class="form-control" name="no_ijazah" id="no_ijazah" placeholder="Masukan Nomor Ijazah" required value="{{ old('no_ijazah') }}">
                            @error('no_ijazah')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status Ijazah</label>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status_ijazah"
                                            id="available" value="available">
                                            Ada
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status_ijazah"
                                            id="unavailable" value="unavailable">
                                            Tidak Ada
                                    </label>
                                </div>
                            </div>
                            @error('status_ijazah')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" href="student">Submit</button>
                        <a class="btn btn-light" href="{{ route('dashboard.ijazah.index') }}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- fitur search input --}}
    <script>
        // Mendapatkan elemen-elemen yang diperlukan
        const selectElement = document.getElementById('mySelect');
        const searchInput = document.getElementById('searchInput');

        // Mendengarkan perubahan pada input pencarian
        searchInput.addEventListener('input', function() {
            const searchValue = searchInput.value.toLowerCase();

            // Mengatur opsi yang sesuai dengan input pencarian
            Array.from(selectElement.options).forEach(function(option) {
                const optionText = option.text.toLowerCase();
                const optionValue = option.value;

                if (optionText.includes(searchValue)) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        });
    </script>
@endsection
