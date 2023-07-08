@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Import Data Mahasiswa</h4>
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
                    <form class="forms-sample" action="{{ route('importPost.student') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group">
                            <label for="image">Upload File</label>
                            <input type="file" name="file" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" name="image" disabled
                                    placeholder="Upload File">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" href="student">Submit</button>
                        <button class="btn btn-light" href="student">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
