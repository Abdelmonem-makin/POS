<div class=" ">
    <div class="row">
        <header class="navbar navbar-light sticky-top flex-md-nowrap p-0 ">
            <nav class="navbar navbar-dark  bg-dark fixed-top  p-0">
                <a class="navbar-brand col-md-3 col-lg-2 mx-3 col-4 mx-4 pe-4  me-5 my-2" href="#">

                    صيدلية عروس كردفان</a>
                <div class=" ">
                    <ul class="nav mx-3">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link text-light dropdown-toggle p-0 h-100" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownId">
                                    <div class="az-dropdown-header d-sm-none">
                                        <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                                    </div>
                                    <div class="me-3" style='text-align:center; '>
                                        <div class="az-img-user" style="font-size: 30px;">
                                            <i class="fa fa-user-secret"></i>
                                        </div><!-- az-img-user -->

                                        <a href="" class="dropdown-item  text-bold " style='text-align:right;'><i
                                                class="fa fa-user"></i> الملف الشخصي </a>
                                        <a href="{{ route('Home') }}" style='text-align:right;' class="dropdown-item   "><i
                                                class="fa fa-print"></i> الكاشير </a>
                                        <a href="{{ route('logout') }}" class="dropdown-item " style='text-align:right;'
                                            onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off"></i> نسجيل الخروج </a>
                                        </h6>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div><!-- az-header-profile -->
                                </div><!-- dropdown-menu -->
                            </li>
                        @endguest

                    </ul>

                </div>

                <button class="navbar-toggler me-3   d-md-none collapsed " type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="تبديل التنقل">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </header>

        <nav id="sidebarMenu" class=" overflow-auto col-md-3 col-lg-2 d-md-block bg-dark  sidebar collapse">
            <div class="position-sticky px-2 ">
                <ul class="nav flex-column  mt-5">
                    <li class="nav-item py-2">
                        <a class="nav-link active" aria-current="page" href="{{ route('dashboard.index') }}">
                            <span data-feather="home"></span>
                            <i class="fa fa-th ms-2"></i>
                            الرئيسية
                        </a>
                    </li>
                    @if (auth()->user()->hasPermission('Category_read'))
                        <li class="nav-item py-2">
                            <a class="nav-link" href="{{ route('Category.index') }}">
                                <span data-feather="users"></span>
                                <i class="fa fa-th ms-2"></i>
                                الاقسام
                            </a>
                        </li>
                    @endif


                    @if (auth()->user()->hasPermission('Product_read'))
                        <li class="nav-item py-2">
                            <a class="nav-link" href="{{ Route('Product.index') }}">
                                <span data-feather="shopping-cart"></span>
                                <i class="fa fa-th ms-2"></i>
                                المنتجات
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermission('Stock_read'))
                        <li class="nav-item py-2">
                            <a class="nav-link" href="{{ Route('Stock.index') }}">
                                <span data-feather="shopping-cart"></span>
                                <i class="fa fa-th ms-2"></i>
                                المخزون
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermission('Order_read'))
                        <li class="nav-item py-2">
                            <a class="nav-link" href="{{ Route('Order.index') }}">
                                <span data-feather="file"></span>
                                <i class="fa fa-th ms-2"></i>
                                الطلبات
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->hasPermission('users_read'))
                        <li class="nav-item py-2">
                            <a class="nav-link" href="{{ route('User.index') }}">
                                <span data-feather="users"></span>
                                <i class="fa fa-th ms-2"></i>
                                المشرفين
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermission('Shift_read'))
                        <li class="nav-item py-2">
                            <a class="nav-link" href="{{ route('Shift.index') }}">
                                <span data-feather="Shift"></span>
                                <i class="fa fa-th ms-2"></i>
                                الورديات
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermission('Payment_read'))
                        <li class="nav-item py-2">
                            <a class="nav-link" href="{{ route('Payment.index') }}">
                                <span data-feather="Payment"></span>
                                <i class="fa fa-th ms-2"></i>
                                طرق الدفع
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermission('supplier_read'))
                        <li class="nav-item py-2">
                            <a class="nav-link" href="{{ route('supplier.index') }}">
                                <span data-feather="users"></span>
                                <i class="fa fa-th ms-2"></i>
                                الموردين
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->hasPermission('Order_read'))
                        <li class="nav-item py-2">
                            <a class="nav-link" href="{{ route('Order_incame') }}">
                                <span data-feather="users"></span>
                                <i class="fa fa-th ms-2"></i>
                                الايرادات
                            </a>
                        </li>
                    @endif

                    <li class="nav-item py-2">
                        <div class="accordion  border-0" id="accordionExample">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button bg-dark  text-white collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true"
                                        aria-controls="collapseTwo">
                                        <span data-feather="bar-chart-2"></span>

                                        <i class="fa fa-th ms-2"></i>
                                        التقارير
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse   bg-dark collapse "
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body border-whiit ">
                                        <a class="nav-link" href="#">تقرير يومي</a>
                                        <a class="nav-link" href="#">تقرير اسبوعي</a>
                                        <a class="nav-link" href="#">تقرير شهري</a>
                                        <a class="nav-link" href="#">تقرير سنوي</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>
        </nav>
    </div>
</div>
