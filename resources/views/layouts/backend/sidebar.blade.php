<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
{{-- <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar"> --}}
    
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <i class="fab fa-laravel"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Marothon</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('dashboard')">
        <a class="nav-link " href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    @hasanyrole('owner|admin|staff|general_manager')
                <!-- Nav Item - Pages Product Menu -->
                <li class="nav-item @yield('product-active')">
                    <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#Product"
                        aria-expanded="true" aria-controls="Product">
                        <i class="fas fa-barcode"></i>
                        <span>Products</span>
                    </a>
                    <div id="Product" class="collapse @yield('product')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item @yield('list_product')" href="{{ route('product') }}">List Product</a>
                            <a class="collapse-item @yield('add_product')" href="/product/create">Add Product</a>
                        </div>
                    </div>
                </li>
            @role('owner')
                  <!-- Nav Item - Pages production Menu -->
                  <!-- <li class="nav-item @yield('production-active')">
                    <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#production"
                        aria-expanded="true" aria-controls="production">
                        <i class="fas fa-sitemap"></i>
                        <span>Productions</span>
                    </a>
                    <div id="production" class="collapse @yield('production')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item @yield('list_row')" href="{{ route('row') }}"> <i class="fas fa-database"></i> List Row Material</a>
                        <a class="collapse-item @yield('list_issue')" href="{{ route('issue') }}"><i class="fas fa-box-tissue"></i> List Issue</a>
                        <a class="collapse-item @yield('add_issue')" href="/issue/create"><i class="fas fa-plus-square"></i> Add Issue</a>
                        <a class="collapse-item @yield('list_process')" href="{{ route('process') }}"><i class="fab fa-product-hunt"></i> List Process</a>
                        <a class="collapse-item @yield('add_process')" href="/process/create"><i class="fas fa-plus-square"></i> Add Process</a>
                        {{-- <a class="collapse-item @yield('list_final')" href="/issue/create"><i class="fas fa-suitcase"></i> List Final</a>
                        <a class="collapse-item @yield('add_final')" href="/issue/create"><i class="fas fa-plus-square"></i> Add Final</a> --}}
                        </div>
                    </div>
                </li> -->
            @endrole
                 <!-- Nav Item - Pages Purchases Menu -->
                 <li class="nav-item @yield('purchases-active')">
                    <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#Purchases"
                        aria-expanded="true" aria-controls="Purchases">
                        <i class="fas fa-shopping-basket"></i>
                        <span>Purchases</span>
                    </a>
                    <div id="Purchases" class="collapse @yield('purchases')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item @yield('list_purchases')" href="{{ route('purchases') }}">List Purchases</a>
                            <a class="collapse-item @yield('add_purchases')" href="/purchases/create">Add Purchases</a>
                        </div>
                    </div>
                </li>
            @role('owner|admin|general_manager')
                <!-- Nav Item - Pages People Menu -->
                <li class="nav-item @yield('people-active')">
                    <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#people"
                        aria-expanded="true" aria-controls="people">
                        <i class="fas fa-users"></i>
                        <span>People</span>
                    </a>
                    <div id="people" class="collapse @yield('people')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item @yield('list_user')" href="{{ route('user') }}">List User</a>
                        <a class="collapse-item @yield('list_customer')" href="{{ route('customer') }}">List Customer</a>
                        <a class="collapse-item @yield('list_supplier')" href="{{ route('supplier') }}">List Supplier</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item @yield('report-active')">
                    <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#report"
                        aria-expanded="true" aria-controls="report">
                        <i class="fas fa-chart-bar"></i>
                        <span>Report</span>
                    </a>
                    <div id="report" class="collapse @yield('report')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item @yield('report_product')" href="{{ route('report/product') }}">Product Report</a>
                        {{-- <a class="collapse-item @yield('report_category')" href="{{ route('report/category') }}">Category Report</a>
                        <a class="collapse-item @yield('report_brand')" href="{{ route('report/brand') }}">Brand Report</a> --}}
                        {{-- <a class="collapse-item @yield('report_dailysale')" href="{{ route('report/daily_sale') }}">Daily Sale Report</a>
                        <a class="collapse-item @yield('report_monthlysale')" href="{{ route('report/monthly_sale') }}">Monthly Sale Report</a> --}}
                        <a class="collapse-item @yield('report_sale')" href="{{ route('report/sale') }}">Sale Report</a>
                        {{-- <a class="collapse-item @yield('report_sale_item')" href="{{ route('report/sale_item') }}">Sale Item Report</a> --}}
                        <a class="collapse-item @yield('report_purchases')" href="{{ route('report/purchases') }}">Purchases Report</a>
                        {{-- <a class="collapse-item @yield('report_purchases_item')" href="{{ route('report/purchases_item') }}">Purchases Item Report</a> --}}
                        </div>
                    </div>
                </li>
                @role('owner|admin')
                <!-- Nav Item - Pages Category Menu -->
                <li class="nav-item @yield('Setting-active')">
                    <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#Category"
                        aria-expanded="true" aria-controls="Category">
                              <i class="fas fa-fw fa-cog"></i>

                        <span>Settings</span>
                    </a>
                    <div id="Category" class="collapse @yield('Setting')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            {{-- <a class="collapse-item @yield('list_Bot')" href="{{ route('bot') }}">Bot</a> --}}
                            <a class="collapse-item @yield('list_Category')" href="{{ route('category') }}">Categories</a>
                            {{-- <a class="collapse-item @yield('list_Subcategory')" href="{{ route('subcategory') }}">Subcategory</a> --}}
                            <a class="collapse-item @yield('list_Unit')" href="{{ route('unit') }}">Unit</a>
                            <a class="collapse-item @yield('list_Brand')" href="{{ route('brand') }}">Brand</a>
                            <a class="collapse-item @yield('list_Warehouse')" href="{{ route('warehouse') }}">Warehouse</a>
                            <a class="collapse-item @yield('list_Payment_method')" href="{{ route('payment_method') }}">Payment Method</a>
                        </div>
                    </div>
                </li>
                @endrole
            @endrole
        @role('owner')
            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse @yield('Components')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item @yield('Buttons')" href="{{ route('buttons') }}">Buttons</a>
                        <a class="collapse-item @yield('Cards')"  href="{{ route('cards') }}">Cards</a>
                    </div>
                </div>
            </li> -->
            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="{{ route('utilities-colors') }}">Colors</a>
                        <a class="collapse-item" href="{{ route('utilities-borders') }}">Borders</a>
                        <a class="collapse-item" href="{{ route('utilities-animations') }}">Animations</a>
                        <a class="collapse-item" href="{{ route('utilities-other') }}">Other</a>
                    </div>
                </div>
            </li> -->
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="{{ route('login') }}">Login</a>
                        <a class="collapse-item" href="{{ route('register') }}">Register</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="{{ route('404-page') }}">404 Page</a>
                        <a class="collapse-item" href="{{ route('blank-page') }}">Blank Page</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('chart') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tables') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>
        @endrole
    @endhasanyrole

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>