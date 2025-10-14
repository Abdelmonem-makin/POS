@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>إنشاء جرد جديد</h3>
        <div class="col-7 my-1">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('inventory.store') }}">
                @csrf
                <h4>جرد شهر {{ \Carbon\Carbon::now()->format('F Y') }}</h4>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>المنتج</th>
                            <th>الكمية في النظام</th>
                            <th>الكمية في الصيدليه</th>
                            <th>رأس المال</th>
                            <th>الفرق</th>
                            <th>إجمالي الفرق</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Product as $product)
                            @php
                                $diff = old("actual_quantity.$product->id") - $product->Quantity;
                                $totalDiff = $diff * $product->sell_price;
                            @endphp
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->Quantity }}</td>
                                <td>
                                    <input type="number" name="actual_quantity[{{ $product->id }}]" class="form-control"
                                        required>
                                </td>
                                <td>{{ number_format($product->sell_price, 2) }}</td>
                                <td>{{ $diff ?? '-' }}</td>
                                <td>{{ number_format($totalDiff, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="btn btn-success">حفظ الجرد الشهري</button>
            </form>
        </div>
    @endsection
