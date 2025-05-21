@extends('master.adminMaster')
@section('title', __('الرئيسيه'))
@section('content')
    <div class="row ">
        <div class="col-xl-12">
            <div class="card ">
                <div class="card-header py-0 ">
                    <div class="d-flex justify-content-between">
                        <h3 class=" my-1 me-a"> الرئيسيه </h3>
                        <ol class="breadcrumb my-2">
                           <li><i class="fa fa-home" aria-hidden="true"></i> الرئيسيه  </li>
                        </ol>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div>
                            <div data-bs-spy="scroll" data-bs-target="#nav-example" data-bs-smooth-scroll="true"
                                tabindex="0">
                                <div id="div1" class="bg-primary" style="height: 100vh">
                                    div1
                                </div>
                                <div id="div2" class="bg-success" style="height: 100vh">
                                    div2
                                </div>
                                <div id="div3" class="bg-light" style="height: 100vh">
                                    div3
                                </div>
                            </div>
                        </div>
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
    </div>
@stop
