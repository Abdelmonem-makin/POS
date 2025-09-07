@extends('Master.adminMaster')
@section('title', '  تسوية المديونيه ')
@section('content')
    <div class="card  ">
        <div class="card-header ">


            <div class="d-flex justify-content-start">

                <a href="{{ route('Category.index') }}" class=" nav nav-link me-a">المديونيات</a>
                <h3 class="  me-a">-</h3>
                <p class="nav  text-dark nav-link me-a">     تسوية المديونيه  </p>


            </div>
        </div>
        <div class="card-body w-50 mt-auto  mx-auto">
      


            <form method="POST" action="{{ route('debt.update', $debts->id) }}" class="parsley-style-1"
                id="selectForm2">
                @csrf
                @method('PATCH')

                <div class="row mg-b-20">

                    <div class="row mb-3">
                        <label for="name" class="col-md-3 col-form-label text-md-end">  المبلغ </label>

                        <div class="col-md-8">
                            <input id="name"
                                class="form-control @error('name') is-invalid @enderror" type="number" name="payment" step="0.01" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div>
                        <input class="btn btn-primary  my-3 mx-auto py-x-20" name="submit" type="submit" value="تعديل">
                    </div>
            </form>
        </div>
    </div>
@endsection
