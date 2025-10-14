@extends('layouts.app')
@section('content')
@section('title', 'تقرير الجرد الشهري')
<div class="container">
    <h3>تقرير الجرد لشهر {{ $month }}</h3>



    <table class="table table-bordered">
        <thead>
            <tr>
                <th>المنتج</th>
                <th>الكمية في النظام</th>
                <th>الجرد الفعلي</th>
                <th>رأس المال</th>
                <th>الفرق</th>
                <th>إجمالي الفرق</th>
                <th>تاريخ الجرد</th>
                <th>الموظف</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inventories as $item)
                <tr>
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $item['system_quantity'] }}</td>
                    <td>{{ $item['actual_quantity'] }}</td>
                    <td>{{ number_format($item['cost_price'], 2) }}</td>
                    <td class="{{ $item['difference'] != 0 ? 'text-danger' : 'text-success' }}">
                        {{ $item['difference'] }}
                    </td>
                    <td>{{ number_format($item['total_difference'], 2) }}</td>
                    <td>{{ $item['inventory_date'] }}</td>
                    <td>{{ $item['user_id'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">لا توجد بيانات جرد لهذا الشهر</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot class="bg-light">
            <tr class="fw-bold text-primary">
                <th colspan="1">الإجمالي</th>
                <th>{{ $total_system_qty ?? 0 }}</th>
                <th></th>
                <th>{{ number_format($total_counted_value ?? 0, 2) }}</th>
                <th></th>
                <th>{{ number_format($total_base ?? 0, 2) }}</th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th colspan="9" class="text-center text-dark">
                    💊 إجمالية قيمة الأدوية في النظام :
                    <span class="text-danger">{{ number_format($total_system_value ?? 0, 2) }}</span>
                    &nbsp; | &nbsp;
                    💰 اجمالية قيمة الأدوية بعد  الجرد :
                     <span class="text-success">{{ number_format($total_counted_value ?? 0, 2) }}</span>
                </th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
