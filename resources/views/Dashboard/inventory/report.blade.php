@extends('layouts.app')
@section('content')
<div class="container">
    <h3>تقرير فرق الجرد</h3>
    <a href="{{ route('inventory.index') }}" class="btn btn-secondary mb-3">عودة لقائمة الجرد</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>المنتج</th>
                <!-- الكمية المسجلة في النظام (حقل products.Quantity) -->
                <th>الكمية في النظام</th>
                <!-- آخر كمية تم تسجيلها في جدول inventories لهذا المنتج -->
                <th>  الجرد</th>
                <th>  راس المال</th>
                <!-- الفرق المحسوب = كمية الجرد - كمية النظام -->
                <th>الفرق</th>
                <!-- قيمة الفرق بحسب سعر البيع (تأثير الإيراد) -->
                <th>قيمة الفرق
                    {{-- (سعر البيع) --}}
                </th>
                <!-- هامش الربح للوحدة = sell_price - price -->
                <th>ربح الوحدة (سعر البيع - التكلفة)</th>
                <!-- إجمالي أثر الفرق على الربح = diff * هامش الربح -->
                <th>إجمالي ربح الفرق</th>
                <th>تاريخ آخر جرد</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->name }}</td>
                <td>{{ $r->system_qty }}</td>
                <!-- إذا لم يوجد سجل جرد، نعرض 0 -->
                <td>{{ $r->counted_qty ?? 0 }}</td>
                {{-- راس المال في الصيدليه --}}
                <td>{{ $r->base}}</td>
                <!-- الفرق يمكن أن يكون موجب (زيادة) أو سالب (نقص) -->
                <td>{{ $r->diff }}</td>
                <!-- قيمة الفرق تعرض برقم عشري بثانيتين -->
                <td>{{ number_format($r->value_diff, 2) }}</td>
                <!-- هامش الربح لكل وحدة -->
                <td>{{ number_format($r->profit_per_unit, 2) }}</td>
                <!-- إجمالي ربح/خسارة ناتجة عن الفرق -->
                <td>{{ number_format($r->profit_diff, 2) }}</td>
                <td>{{ $r->counted_at ? \Carbon\Carbon::parse($r->counted_at)->format('Y-m-d') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">الإجمالي</th>
                <th>{{ $total_system_qty ?? 0 }}</th>
                <th>{{ $total_counted_qty ?? 0 }}</th>
                <th>{{ $total_base ?? 0 }}</th>
                <th></th>
                <th>{{ number_format($total_value_diff ?? 0, 2) }}</th>
                <th></th>
                <th>{{ number_format($total_profit_diff ?? 0, 2) }}</th>
                <th></th>
            </tr>
            <tr>
                <th colspan="9">قيمة إجمالية الادويه في النظام => {{ number_format($total_system_value ?? 0, 2) }} &nbsp; | &nbsp; قيمة إجمالية بعد الجرد: {{ number_format($total_counted_value ?? 0, 2) }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
