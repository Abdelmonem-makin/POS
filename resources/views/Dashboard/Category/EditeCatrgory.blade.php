@extends('Master.adminMaster')
@section('title','تعديل بيانات قسم')
@section('content')
 <div class="card  ">
            <div class="card-header ">


                <div class="d-flex justify-content-start">

                    <a href="{{route("Category.index")}}" class=" nav nav-link me-a">الاقسام</a>
                    <h3 class="  me-a">-</h3>
                    <p  class="nav  text-dark nav-link me-a">تعديل بيانات قسم </p>


                </div>
            </div>
            <div class="card-body w-50 mt-auto  mx-auto">
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <p class="text-center ">{{Session::get('success')}}</p>
                </div>
                @endif


                <form method="POST" action="{{route('Category.update',$resource->id)}}"  class="parsley-style-1"
                            id="selectForm2" >
                            @csrf
                    @method('PATCH')

                        <div class="row mg-b-20">

                            <div class="row mb-3">
                                <label for="name" class="col-md-3 col-form-label text-md-end">اسم القسم</label>

                                <div class="col-md-8">
                                    <input id="name" value="{{$resource->name}}"  type="text" class="form-control @error('name') is-invalid @enderror" name="name"  required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div>
                                <input class="btn btn-primary  my-3 mx-auto py-x-20" name="submit" type="submit"
                                    value="تعديل">
                            </div>
                </form>
            </div>
        </div>
@endsection
