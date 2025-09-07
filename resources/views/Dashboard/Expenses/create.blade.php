@extends('Master.adminMaster')
@section('title', ' اضافة مصروق ')
@section('content')
    <div class="card  ">
        <div class="card-header ">


            <div class="d-flex justify-content-start">

                <a href="{{ route('Expense.index') }}" class=" nav nav-link me-a">المصروقات</a>
                <h3 class="  me-a">-</h3>
                <p class="nav  text-dark nav-link me-a">اضافة مصروق </p>


            </div>
        </div>

        <div class="card-body w-100 mt-auto">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <p class="text-center ">{{ Session::get('success') }}</p>
                </div>
            @endif
            <form action="{{ route('Expense.store') }}" method="POST" class="p-4 border rounded shadow-sm bg-light">
                @csrf

           

                <div class="mb-3">
                    <label for="title" class="form-label">عنوان المصروف</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">الوصف</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">القيمة</label>
                    <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="expense_date" class="form-label">تاريخ المصروف</label>
                    <input type="date" class="form-control" id="expense_date" name="expense_date" required>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">التصنيف</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">اختر التصنيف</option>
                        <option value="إيجار">إيجار</option>
                        <option value="رواتب">رواتب</option>
                        <option value="خدمات">خدمات</option>
                        <option value="صيانة">صيانة</option>
                        <option value="أخرى">أخرى</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">حفظ المصروف</button>
            </form>

            {{-- <form method="POST" action="{{ route('supplier.store') }}" id="selectForm2">
                @csrf
                <div class="row">

                    <div class="col-6 mb-3">
                        <div class="row">

                            <label for="name" class="col-md-3 col-form-label text-md-start  ">اسم المورد</label>
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        autocomplete="name">
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
                                    autocomplete="compane_name">
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
                                    autocomplete="address">
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
                                    autocomplete="phone">
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
                            {{ __('trans.Register') }}
                        </button>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>
@endsection
