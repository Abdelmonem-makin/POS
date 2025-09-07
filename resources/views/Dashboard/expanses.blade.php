@extends('layouts.app')
@section('content')
@if (Session::has('error'))
<div id="alertBox" class="alert  alert-danger " role="alert">
    <p class="text-center ">{{ Session::get('error') }}</p>
</div>
@endif
@if (Session::has('success'))
<div id="alertBox" class="alert alert-success d-none " role="alert">
    <p class="text-center ">{{ Session::get('success') }}</p>
</div>
@endif

     <form action="{{ route('Expense.store') }}" method="POST" class="p-4 border w-50 m-auto rounded shadow-sm bg-light">
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
 



                <button type="submit" class="btn btn-primary">حفظ المصروف</button>
            </form>

@endsection
