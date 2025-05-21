@extends('Master.adminMaster')
@section('title','  تعديل بيانات المنتجات')
@section('content')
 <div class="card  ">
            <div class="card-header ">


                <div class="d-flex justify-content-start">

                    <a href="{{route("Product.index")}}" class=" nav nav-link me-a"> المنتجات</a>
                    <h3 class="  me-a">-</h3>
                    <p  class="nav  text-dark nav-link me-a" >  تعديل بيانات المنتجات </p>


                </div>
            </div>

            <div class="card-body w-75 mt-auto">
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <p class="text-center ">{{Session::get('error   ')}}</p>
                </div>
                @endif
                <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                    <img class="form-control  w-50" src="{{asset($editID->photo)}}">
                </div>
                <form method="POST" action="{{ route('Product.update', ['Product'=>$editID->id] ) }}"  enctype="multipart/form-data" id="selectForm2">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" value="{{$editID->id}}" name="id">

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-start mx-5">الاسم</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$editID->name}}"  autocomplete="name" autofocus>

                            @error('name')
                               <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="photo" class="col-md-4 col-form-label text-md-start mx-5">الصوره</label>

                        <div class="col-md-6">
                            <input type="file"  class="form-control @error('photo') is-invalid @enderror  "  value="{{$editID->photo}}"  name="photo" id="photo">
                                @error('photo')
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="categories_id" class="col-md-4 col-form-label text-md-start mx-5">القسم</label>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <select class="form-select form-select-md @error('categories_id') is-invalid @enderror" name="categories_id" id="categories_id" data-placeholder=" اختار القسم ....." style="width:100%">
                                    <option value="{{$editID->id}}" selected>{{$editID->Categorie->name}}</option>

                                    @isset($Categorys)
                                    @foreach ($Categorys as $Category)
                                        <option value="{{$Category->id}}">
                                            {{ $Category->name}}
                                            </option>
                                        @endforeach
                                    @endisset

                                </select>
                                @error('categories_id')
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                            </div>


                        </div>
                    </div>

                    <div class="row mb-3">

                        <label for="price" class="col-md-4 col-form-label text-md-start mx-5">السعر</label>

                        <div class="col-md-6">
                            <input id="price" value="{{$editID->price}}" type="number" class="form-control @error('price') is-invalid @enderror" name="price"  autocomplete="price">
                            @error('price')
                            <span class="text-danger">{{$message}}*</span>
                            @enderror
                     </div>

                    </div>

                    <div class="row mb-3">
                        <label for="discription" class="col-md-4 col-form-label text-md-start mx-5">الوصف</label>

                        <div class="col-md-6">
                                <textarea id="discription"   class="form-control @error('discription') is-invalid @enderror" name="discription" value="{{$editID->discription}}"  autocomplete="discription" autofocus rows="3"></textarea>
                                @error('discription')
                                <span class="text-danger">{{$message}}*</span>
                                @enderror
                            </div>

                    </div>

                        <div class="row md-3">
                                <label class="col-md-4 col-form-label text-md-start mx-5">الحاله</label>
                                <div class="col-md-6">

                                    <div  class="form-check  form-switch ">
                                        <input class=" form-check-input  @error('status') is-invalid @enderror" value="1" name="status" type="checkbox" @if ($editID->status == 1) checked @endif>
                                        @error('status')
                                        <span class="text-danger">{{$message}}*</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="">
                                </div>
                        </div>



                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4 text-md-start me-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
