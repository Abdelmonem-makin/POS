@extends('master.adminMaster')
@section('title', 'الجرد')
@section('content')

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-0">


                    <div class="d-flex justify-content-between">
                        <h3> الجرد</h3>

                        <form method="POST" class="row" action="{{ route('inventory.store') }}">
                            @csrf
                            <div class="col-4 mb-3">
                                <div class="row">
                                    <label for="product_id" class="col-md-3 col-form-label text-md-start "> المنتج</label>
                                    <div class="col-md-9">

                                        <select name="product_id" class="form-control">
                                            <option selected disabled value="">اختر المنتج</option>
                                            @foreach ($Product as $p)
                                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="row">
                                    <label for="quantity" class="col-md-3 col-form-label text-md-start ">الكميه</label>

                                    <div class="col-md-9">
                                        <input id="quantity" type="number"
                                            class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                            autocomplete="quantity">
                                        @error('quantity')
                                            <span class="text-danger">{{ $message }}*</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-3">

                                <button class="btn col-md-4 btn-success">حفظ  </button>
                                <a href="{{ route('inventory.report') }}" class="btn btn-info  ms-2">عرض تقرير الجرد</a>

                            </div>
                        </form>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered  text-center table-striped mg-b-0 p-0 text-md-nowrap">
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
                                    @foreach ($inventories as $inv)
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
                    </div>
                </div>
            </div>
        </div>

    @endsection
