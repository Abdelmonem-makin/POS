@extends('master.adminMaster')
@section('title', 'الجرد')
@section('content')

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card ">
                <div class="card-header py-0">


                    <div class="d-flex justify-content-between">
                        <h3> الجرد</h3>


                        <a href="{{ route('inventory.create') }}" class="btn btn-primary my-1   ms-a">جرد جديد +</a>

                    </div>


                </div>
            </div>
            <div class="container">
                <h3 class="my-4">📦 تقارير الجرد الشهري</h3>
                <hr>
                <div class="row">
                    @forelse($months as $month)
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm border-primary">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title mb-1">جرد شهر {{ $month->translatedFormat('F Y') }}</h5>
                                        <small class="text-muted">{{ $month->format('Y-m') }}</small>
                                    </div>
                                    <a href="{{ route('inventory.report', ['month' => $month->format('Y-m')]) }}"
                                        class="btn btn-outline-primary">
                                        عرض التقرير
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                لا توجد تقارير جرد مسجلة حتى الآن.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>



        </div>

    @endsection
