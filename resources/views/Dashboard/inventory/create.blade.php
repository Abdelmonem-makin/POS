@extends('layouts.app')
@section('content')
<div class="container">
    <h3>إنشاء جرد جديد</h3>
    <form method="POST" action="{{ route('inventory.store') }}">
        @csrf
        <div class="mb-3">
            <label>المنتج</label>

            <select name="product_id" class="form-control">
                <option disabled  selected value="">اختر المنتج</option>
               
            </select>
        </div>
        <div class="mb-3">
            <label>الكمية</label>
            <input name="quantity" type="number" class="form-control" required value="0">
        </div>

        <button class="btn btn-success">حفظ الجرد</button>
    </form>
</div>
@endsection
