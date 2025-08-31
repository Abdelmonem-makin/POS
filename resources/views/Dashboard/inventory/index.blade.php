@extends('master.adminMaster')
@section('title', 'الجرد')
@section('content')

<div class="container">
    <h3>قائمة الجرد</h3>
    <a href="{{ route('inventory.create') }}" class="btn btn-primary mb-3">  جرد جديد</a>
    <a href="{{ route('inventory.report') }}" class="btn btn-info mb-3 ms-2">عرض تقرير     الجرد</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>المنتج</th>
                <th>الكمية</th>
                <th>المستخدم</th>
                <th>تاريخ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventories as $inv)
            <tr>
                <td>{{ $inv->id }}</td>
                <td>{{ $inv->product?->name }}</td>
                <td>{{ $inv->quantity }}</td>
                <td>{{ $inv->user?->name }}</td>
                <td>{{ $inv->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $inventories->links() }}
</div>
@endsection
