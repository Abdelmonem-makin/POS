@extends('Master.adminMaster')
@section('title', ' تعديل بيانات مورد ')
@section('content')
    <div class="card  ">
        <div class="card-header ">


            <div class="d-flex justify-content-start">

                <a href="{{ route('supplier.index') }}" class=" nav nav-link me-a">الموردين</a>
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

            <form method="POST" action="{{ route('supplier.update' , $supplier->id) }}" id="selectForm2">
                @csrf
                @method('PATCH')

                <div class="row">

                    <div class="col-6 mb-3">
                        <div class="row">

                            <label for="name" class="col-md-3 col-form-label text-md-start  ">اسم المورد</label>
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{$supplier->name}}" autocomplete="name">
                                    @error('name')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="row">
                            <label for="compane_name" class="col-md-3 col-form-label text-md-start ">اسم الشركه</label>

                            <div class="col-md-9">
                                <input id="compane_name" type="text"
                                    class="form-control @error('compane_name') is-invalid @enderror" name="compane_name"
                                    value="{{$supplier->compane_name}}" autocomplete="compane_name">
                                @error('compane_name')
                                    <span class="text-danger">{{ $message }}*</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="row">
                            <label for="address" class="col-md-3 col-form-label    "> العنوان
                            </label>

                            <div class="col-md-9">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{$supplier->address}}" autocomplete="address">
                                @error('address')
                                    <span class="text-danger">{{ $message }}*</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="row">
                            <label for="phone" class="col-md-3 col-form-label text-md-start  ">رقم الهاتف</label>

                            <div class="col-md-9">
                                <input id="phone" type="number"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{$supplier->phone}}" autocomplete="phone">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}*</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>




                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4   me-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('trans.updata') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
