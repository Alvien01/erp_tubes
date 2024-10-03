<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="{{ asset('images/ERP_Logo.png') }}" type="image/x-icon">

<head>
    {{-- CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.4/fetch.min.js"></script>
    {{-- TOKEN --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- CDN/JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    {{-- CDN Search ORDER --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <!-- Favicons -->
    {{-- <link href="{{ asset('assets/img/favicon.png') }}" rel=" youtube"> --}}
    {{-- <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> --}}

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!-- Navbar -->
    <header id="header" class="header fixed-top d-flex align-items-center bg-primary">

        <div class="d-flex align-items-center justify-content-between">
        <i class="bi bi-list toggle-sidebar-btn text-light"></i>
            <a href="{{ url('dashboard') }}" class="logo d-flex align-items-center">
                <!-- <img src="{{ asset('images/pc.jpg') }}" alt="ERP Logo" width="250" height="100"> -->
                <span class="d-none d-lg-block text-light"></span>
            </a>
        </div><!-- End Logo -->


<!-- 
        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div> -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <!-- End Search Icon-->
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2 text-light">Admin</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Admin</h6>
                            <span>Admin</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->
    </header>
    <!-- End Navbar -->

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar bg-primary">
        <ul class="sidebar-nav" id="sidebar-nav">

            {{-- Dashboard --}}
            <li class="nav-item ">
                <a class="nav-link {{ request()->is('dashboard*') ? '' : 'collapsed' }}"
                    href="{{ url('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <br>

            {{-- Manufaktur --}}
            <li class="nav-item ">
                <a class="nav-link {{ request()->is('manufaktur/produk*') || request()->is('manufaktur/bahan*') || request()->is('manufaktur/create-produk*') || request()->is('manufaktur/create-bom*') || request()->is('manufaktur/bom*') || request()->is('manufaktur/create-bahan*') || request()->is('manufaktur/detail-bom*') ? '' : 'collapsed' }}"
                    data-bs-target="#manufaktur-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Manufaktur</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <br>
                <ul id="manufaktur-nav"
                    class="nav-content {{ request()->is('manufaktur/produk*') || request()->is('manufaktur/bahan*') || request()->is('manufaktur/create-produk*') || request()->is('manufaktur/create-bahan*') || request()->is('manufaktur/create-bom*') || request()->is('manufaktur/bom*') || request()->is('manufaktur/detail-bom*') ? 'collapse show' : 'collapse' }}"
                    data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="{{ url('/manufaktur/produk') }}"
                            class="{{ request()->is('manufaktur/produk*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Data Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/manufaktur/bahan') }}"
                            class="{{ request()->is('manufaktur/bahan*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Data Bahan</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('manufaktur/create-produk') }}"
                            class="{{ request()->is('manufaktur/create-produk*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Tambah Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('manufaktur/create-bahan') }}"
                            class="{{ request()->is('manufaktur/create-bahan*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Tambah Bahan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('manufaktur/bom') }}"
                            class="{{ request()->is('manufaktur/bom*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>BoM</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('manufaktur/create-bom') }}"
                            class="{{ request()->is('manufaktur/create-bom*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Tambah BoM</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('manufaktur/order') }}"
                            class="{{ request()->is('manufaktur/order*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Order</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item ">
                <a class="nav-link {{ request()->is('purchase/vendor*') ? '' : 'collapsed' }}"
                    data-bs-target="#purchase-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Purchasing</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <br>
                <ul id="purchase-nav"
                    class="nav-content {{ request()->is('purchase/vendor*') || request()->is('purchase/rfq*') || request()->is('purchase/bill*') || request()->is('purchase/pembayaran-bill*') ? 'collapse show' : 'collapse' }}"
                    data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="{{ url('/purchase/vendor') }}"
                            class="{{ request()->is('purchase/vendor*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Vendor</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/purchase/rfq') }}"
                            class="{{ request()->is('purchase/rfq*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Request for Quotation</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/purchase/bill') }}"
                            class="{{ request()->is('purchase/bill*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Bill</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/purchase/pembayaran-bill') }}"
                            class="{{ request()->is('purchase/pembayaran-bill*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Data Pembayaran</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item ">
                <a class="nav-link {{ request()->is('sales/customer*') ? '' : 'collapsed' }}"
                    data-bs-target="#sales-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Sales</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <br>
                <ul id="sales-nav"
                    class="nav-content {{ request()->is('sales/customer*') ? 'collapse show' : 'collapse' }}"
                    data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="{{ url('/sales/customer') }}"
                            class="{{ request()->is('sales/customer*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Customer</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/sales/quotation') }}"
                            class="{{ request()->is('sales/quotation*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Quotation</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/sales/order') }}"
                            class="{{ request()->is('sales/order*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Orders</span>
                        </a>
                    </li>

                    {{-- <li>
                        <a href="{{ url('/purchase/rfq') }}"
                            class="{{ request()->is('purchase/rfq*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Request for Quotation</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/purchase/bill') }}"
                            class="{{ request()->is('purchase/bill*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Bill</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/purchase/pembayaran-bill') }}"
                            class="{{ request()->is('purchase/pembayaran-bill*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Data Pembayaran</span>
                        </a>
                    </li> --}}
                </ul>
            </li>

            {{-- Menu --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard*') ? '' : 'collapsed' }}"
                    href="{{ url('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Menu</span>
                </a>
            </li>

        </ul>
    </aside>

    <!-- End Sidebar-->

    {{-- Content --}}


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@yield('pageTitle')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">@yield('pageSubTitle')</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        @yield('content')

    </main>
    {{-- End Content --}}

    <!-- Footer -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Alfin Ardiansyah</span></strong>. All Rights Reserved
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('/vendor/php-email-form/validate.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('/js/main.js') }}"></script>

</body>

</html>
