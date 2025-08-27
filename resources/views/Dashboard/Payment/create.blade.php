@extends('Master.adminMaster')
@section('title', ' اضافة طريقة دفع ')
@section('content')
    <div class="card  ">
        <div class="card-header ">


            <div class="d-flex justify-content-start">

                <a href="{{ route('Payment.index') }}" class=" nav nav-link me-a">الطريقة دفع </a>
                <h3 class="  me-a">-</h3>
                <p class="nav  text-dark nav-link me-a">اضافة طريقة دفع </p>


            </div>
        </div>

        <div class="card-body w-75 mt-auto">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <p class="text-center ">{{ Session::get('success') }}</p>
                </div>
            @endif
            <form method="POST" action="{{ route('Payment.store') }}" id="selectForm2">
                @csrf
                <div class="row">

                    <div class="col-12 mb-3">
                        <div class="row">

                            <label for="method_name" class="col-md-3 col-form-label text-md-start  ">اسم الطريقة دفع
                            </label>
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <input id="method_name" type="text"
                                        class="form-control @error('method_name') is-invalid @enderror"
                                        name="method_name" autocomplete="method_name">
                                    @error('method_name')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>


                            </div>
                        </div>
                    </div>

                </div>




                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4   me-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('trans.Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
