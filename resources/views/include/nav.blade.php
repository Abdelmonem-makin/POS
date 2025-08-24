<div class="   ">
    <div class="container">
    <div class="row heder">
        <div class="col-lg-4 col-md-12">
           <div class="my-2">
            <a class="nav-link text-dark header  p-2" href="">

                {{__('trans.E-Commaers')}}

            </a>
           </div>

        </div>
        <div class="col-lg-4 col-md-12">
            <form class="d-flex my-lg-2">
                <input class="form-control  border-danger" type="text" placeholder="Search">
                <button class="btn btn-outline-danger  bg-danger my-2 my-sm-0" type="submit"><i class="fa text-light fa-search" aria-hidden="true"></i></button>
            </form>
        </div>
        <div class="col-lg-4 px-0 col-md-12">

<nav class="navbar">
    <ul class="nav header p-0 me-auto">

        @if (Route::has('login'))

        @auth
        @if (Auth::user()->type==0)
        <li class="nav-item dropdown">
            <a class="nav-link p-2 dropdown-toggle text-dark" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> {{Auth::user()->name}}</a>
            <div class="dropdown-menu" aria-labelledby="dropdownId">
                <a href="{{ route('dashboard') }}" class="dropdown-item p-2 me-auto ">{{__('trans.Dashboard')}}</a>
                <a class="dropdown-item p-2 me-auto" href="{{ route('Logout')}}">Sign out</a>
            </div>
          </li>
        @else
        <li class="nav-item dropdown">
            <a class="nav-link p-2 dropdown-toggle text-dark" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> {{Auth::user()->name}}</a>
            <div class="dropdown-menu" aria-labelledby="dropdownId">
                <a href="{{ route('dashboard') }}" class="dropdown-item p-2 me-auto ">{{__('trans.Dashboard')}}</a>

            <a href="{{ route('profile.show') }}" class="  dropdown-item p-2 me-auto ">{{__('trans.profile')}}</a>
              <a class="dropdown-item p-2 me-auto" href="{{ route('Logout')}}">Sign out</a>
            </div>

          </li>
            @endif
            @else
            <a href="{{ route('login') }}" class="text-sm nav-link text-dark   d-inline p-1">{{__('trans.Login')}}</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class=" text-sm text-dark  nav-link d-inline p-1 mx-2  ">{{__('trans.Register')}}</a>
            @endif
        @endauth

        @endif
        <li class="nav-item dropdown">
         <a class="nav-link p-2 dropdown-toggle text-dark" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{__('trans.languages')}} </a>
         <div class="dropdown-menu" aria-labelledby="dropdownId">
             <a class="dropdown-item" href="{{ route(Route::currentRouteName() , ['language'=>'en']) }}">{{__('trans.En')}}</a>
             <a class="dropdown-item" href="{{ route(Route::currentRouteName() , ['language'=>'ar']) }}">{{__('trans.Ar')}}</a>
         </div>
     </li>
     <li class="nav-item">
        <a class="nav-link text-dark " href="">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> 2
        </a>
    </li>
    </ul>


</nav>
        </div>
    </div>
    </div>
</div>
<nav class="navbar navbar-expand-sm  navbar-dark bg-dark">
      <div class="container">

        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

       <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav p-0 ">
                <li class="nav-item">
                    <a class="nav-link active" href="#" aria-current="page">{{__('trans.Home')}}  <span class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{__('trans.Linke')}}  </a>
                </li>

            </ul>
        </div>


  </div>
</nav>
