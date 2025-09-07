@extends('Master.adminMaster')
@section('title', ' تعديل بيانات الودريه  ')
@section('content')
    <div class="card  ">
        <div class="card-header ">


            <div class="d-flex justify-content-start">

                <a href="{{ route('Shift.index') }}" class=" nav nav-link me-a">الودريه  </a>
                <h3 class="  me-a">-</h3>
                <p class="nav  text-dark nav-link me-a">تعديل بيانات الودريه  </p>


            </div>
        </div>

        <div class="card-body w-75 mt-auto">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <p class="text-center ">{{ Session::get('success') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('Shift.update' , $Shift->id) }}" id="selectForm2">
                @csrf
                @method('PATCH')

               <div class="row">

                    <div class="col-6 mb-3">
                        <div class="row">

                            <label for="name" class="col-md-3 col-form-label text-md-start  ">اسم الورديه </label>
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <select id="name" class="form-control @error('name') is-invalid @enderror" name="name">
                                        <option disabled selected value="">اختار الورديه</option>
                                         <option value="صباحيه" @if (old('name', $Shift->name) == 'صباحيه') selected @endif>صباحيه</option>
                                        <option value="مسائيه" @if (old('name', $Shift->name) == 'مسائيه') selected @endif>مسائيه</option>
                                    </select>
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
                            <label for="compane_name" class="col-md-3 col-form-label text-md-start ">اسم الموظف</label>

                            <div class="col-md-9">
                                <select id="user_id" class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                                    <option disabled selected value="">اختر الموظف</option>
                                    @foreach ($Users as $User)
                                        <option value="{{ $User->id }}" @if ($User->id  == $Shift->user_id) selected @endif >{{ $User->name }} </option>
                                    @endforeach
                                </select>
                                @error('compane_name')
                                    <span class="text-danger">{{ $message }}*</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-6 mb-3">
                        <div class="row">
                            <label for="start_time" class="col-md-3 col-form-label    "> بداية الورديه
                            </label>

                            <div class="col-md-9">
                                <input id="start_time" type="time" value="{{ old('start_time', $Shift->start_time) }}"
                                    class="form-control @error('start_time') is-invalid @enderror" name="start_time"
                                    autocomplete="start_time">
                                @error('start_time')
                                    <span class="text-danger">{{ $message }}*</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="row">
                            <label for="end_time" class="col-md-3 col-form-label text-md-start  ">نهاية الورديه</label>

                            <div class="col-md-9">
                                <input id="end_time" type="time" value="{{ old('end_time', $Shift->end_time) }}"
                                    class="form-control @error('end_time') is-invalid @enderror" name="end_time"
                                    autocomplete="end_time">
                                @error('end_time')
                                    <span class="text-danger">{{ $message }}*</span>
                                @enderror
                            </div>
                        </div>
                    </div> --}}
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
