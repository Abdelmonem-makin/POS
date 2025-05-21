@extends('Master.adminMaster')
@section('title','اضافة مشرف')
@section('content')
 <div class="card  ">
            <div class="card-header ">


                <div class="d-flex justify-content-start">

                    <a href="{{route("User.index")}}" class=" nav nav-link me-a"> المشرفين</a>
                    <h3 class="  me-a">-</h3>
                    <p  class="nav  text-dark nav-link me-a">اضافة مشرف</p>


                </div>
            </div>
            <div class="card-body w-50 mt-auto  mx-auto">
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <p class="text-center ">{{Session::get('success')}}</p>
                </div>
                @endif


                <form action="{{route('Category.store')}}" method="POST" class="parsley-style-1"
                            id="selectForm2" enctype="multipart/form-data">
                            @csrf
                        <div class="row mg-b-20">

                          <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">الاسم الاول</label>
                            <input type="text" class="form-control d-inline" id="validationCustom01" value="Mark" required>
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                          </div>
                          <div class="col-md-4">
                            <label for="validationCustom02" class="form-label"> الاسم الثاني  </label>
                            <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                          </div>
                          <div class="col-md-5">
                            <label for="validationCustomUsername" class="form-label" > البريد الالكتروني </label>
                            <div class="input-group">
                              <span class="input-group-text" id="inputGroupPrepend">@</span>
                              <input type="email" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                              <div class="invalid-feedback">
                                Please choose a username.
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">  كلمة السر</label>
                            <input type="text" class="form-control" id="validationCustom03" required>
                            <div class="invalid-feedback">
                              Please provide a valid city.
                            </div>
                            </div>
                            <div class="col-md-6">

                            <label for="validationCustom03" class="form-label"> تاكيد كلمة السر </label>
                            <input type="text" class="form-control" id="validationCustom03" required>
                            <div class="invalid-feedback">
                              Please provide a valid city.
                            </div>
                         </div>
                          <div class="col-md-3">

                            <div class="form-check form-switch my-3">

                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                              <label class="form-check-label" for="invalidCheck">
                               Status
                              </label>
                            </div>
                        </div>
                            <div>
                                <input class="btn btn-primary  my-3 mx-auto py-x-20" name="submit" type="submit"
                                    value="اضافه">
                            </div>
                </form>
            </div>
        </div>
@endsection
