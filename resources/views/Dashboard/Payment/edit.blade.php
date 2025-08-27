@extends('Master.adminMaster')
@section('title', ' تعديل بيانات مورد ')
@section('content')
    <div class="card  ">
        <div class="card-header ">


            <div class="d-flex justify-content-start">

                <a href="{{ route('Payment.index') }}" class=" nav nav-link me-a">الموردين</a>
                <h3 class="  me-a">-</h3>
                <p class="nav  text-dark nav-link me-a">تعديل بيانات مورد </p>


            </div>
        </div>

        <div class="card-body w-75 mt-auto">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <p class="text-center ">{{ Session::get('success') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('Payment.update', $Payment->id) }}" id="selectForm2">
                @csrf
                @method('PATCH')

                <div class="row">


                    <div class="col-12 mb-3">
                        <div class="row">
                            <label for="method_name" class="col-md-3 col-form-label text-md-start ">اسم الشركه</label>

                            <div class="col-md-9">
                                <input id="method_name" type="text"
                                    class="form-control @error('method_name') is-invalid @enderror" name="method_name"
                                   value="{{$Payment->method_name}}" value="{{ $Payment->method_name }}" autocomplete="method_name">
                                @error('method_name')
                                    <span class="text-danger">{{ $message }}*</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                </div>




                <div class="row mb-0">
             <label for="method_name" class="col-md-3 col-form-label text-md-start ">   </label>

                    <div class="col-md-9  ">
                        <button type="submit" class="btn btn-primary">
                            {{ __('trans.updata') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
