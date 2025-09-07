@extends('Master.adminMaster')
@section('title', 'اضافة مشرف')
@section('content')
    <div class="card  ">
        <div class="card-header py-0">


            <div class="d-flex justify-content-between">
                <h3 class=" my-2 me-a"> المشرفين </h3>

                <ol class="breadcrumb my-2">
                    <a class="py-0 text-dark nav-link" href="{{ route('dashboard.index') }}"><i class="fa fa-home"
                            aria-hidden="true"></i> الرئيسيه </a></li>
                    < <a class="nav-link text-dark py-0" href="{{ route('User.index') }}"> المشرفين </a></li>
                        < <li class="active mx-2">اضافة مشرف</li>
                </ol>


            </div>
        </div>

        <div class="card-body   mt-auto">
            <form method="POST" action="{{ route('User.store') }}">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label text-md-end">اسم المشرف</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-2 col-form-label text-md-end">البريد الاكتروني</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">

                    <label for="type" class="col-md-2 col-form-label text-md-end  ">اسم الوظيفه </label>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <select id="type" class="form-control @error('type') is-invalid @enderror" name="type">
                                <option disabled selected value="">اختار الوظيفه</option>
                                <option value="Admin">مشرف</option>
                                <option value="employe">موظف</option>
                            </select>
                            @error('type')
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-2 col-form-label text-md-end">كلمة السر</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-2 col-form-label text-md-end">تاكيد كلمة السر</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-2 ol-form-label text-md-end">الصلاحيات</label>
                    <div class="col-md-9 p-0">
                        <!-- Nav tabs -->
                        <ul class="nav p-0 nav-tabs" id="myTab" role="tablist">
                            @php
                                $permitions = [
                                    'users',
                                    'Category',
                                    'Product',
                                    'Order',
                                    'stock',
                                    'supplier',
                                    'Shift',
                                    'Payment',
                                    'employe',
                                    'debt'
                                ];
                                $Roles = ['create', 'read', 'update', 'delete'];
                            @endphp
                            @foreach ($permitions as $index => $permition)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $index == 0 ? 'active' : '' }} "
                                        id="home-tab{{ $index }}" data-bs-toggle="tab"
                                        data-bs-target="#home{{ $index }}" type="button" role="tab"
                                        aria-controls="home{{ $index }}"
                                        aria-selected="{{ $index == 1 ? 'true' : 'fales' }}">
                                        {{ __('trans.' . $permition) }} </button>
                                </li>
                            @endforeach

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content pe-2">


                            @foreach ($permitions as $index => $permition)
                                <div class="tab-pane {{ $index == 0 ? 'active' : '' }}  " id="home{{ $index }}"
                                    role="tabpanel" aria-labelledby="home-tab{{ $index }}">
                                    <div class="row justify-content-sm-between">

                                        @foreach ($Roles as $Role)
                                            <div class="col-3  p-0  ">
                                                <div class="form-check p-0 ">
                                                    <label style="    font-size: 13px;" class="form-check-label"
                                                        for=""><input class="form-check-input"
                                                            name='permissions[]'type="checkbox"
                                                            value="{{ $permition . '_' . $Role }}"id="" />
                                                        {{ __('trans.' . $Role) }} {{ __('trans.' . $permition) }} </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endforeach

                        </div>

                    </div>

                </div>

                <div class="row mb-0">
                    <div class="col-md-6  offset-md-4">
                        <button type="submit" class="btn  btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
