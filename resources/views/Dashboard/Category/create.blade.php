@extends('Master.adminMaster')
@section('title', 'الاقسام')
@section('content')
    <div class="card  ">
        <div class="card-header py-0">
            <div class="d-flex justify-content-between">
                <h3 class=" my-2 me-a"> الاقسام </h3>
                <ol class="breadcrumb my-2">
                    <li><a class="py-0 text-dark nav-link" href="{{ route('dashboard.index') }}"><i class="fa fa-home"
                            aria-hidden="true"></i> الرئيسيه </a></li>
                    <<li> <a class="nav-link text-dark py-0" href="{{ route('Category.index') }}"> الاقسام </a></li>
                        < <li class="active mx-2">اضافة قسم</li>
                </ol>
            </div>
        </div>
        <div class="card-body w-50 mt-auto  mx-auto">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <p class="text-center ">{{ Session::get('success') }}</p>
                </div>
            @endif


            <form action="{{ route('Category.store') }}" method="POST" class="parsley-style-1" id="selectForm2"
                enctype="multipart/form-data">
                @csrf
                <div class="row mg-b-20">

                    <div class="row mb-3">
                        <label for="name" class="col-md-3 col-form-label text-md-end">اسم القسم</label>

                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mg-b-20">

                    <div class="row mb-3">
                        <label for="status" class="col-md-3 col-form-label text-md-end"> الحاله  </label>

                        <div class="col-md-8">
                            <div class="form-check  form-switch ">

                                <input class=" form-check-input  @error('status') is-invalid @enderror" value="1"
                                    name="status" type="checkbox" checked>
                                @error('status')
                                    <span class="text-danger">{{ $message }}*</span>
                                @enderror
                            </div>
                            
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- <div class="row md-3">
                    <div class="col-md-6">

                        <div class="form-check  form-switch ">

                            <input class=" form-check-input  @error('status') is-invalid @enderror" value="1"
                                name="status" type="checkbox" checked>
                            @error('status')
                                <span class="text-danger">{{ $message }}*</span>
                            @enderror
                        </div>
                    </div>
                </div> --}}


                <div>
                    <input class="btn btn-primary  my-3 mx-auto py-x-20" name="submit" type="submit" value="اضافه">
                </div>
            </form>
        </div>
    </div>
@endsection
