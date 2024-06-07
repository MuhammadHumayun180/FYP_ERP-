<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
    <div class="sidebar-brand-icon">
    <i><img src="{{ asset('img/logo.png')}}" width="100%" height="100%" alt=""></i>
    </div>
    <div class="sidebar-brand-text mx-3">ERP Admin <sup></sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>HR</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">HR Management:</h6>
            <a class="collapse-item" href="{{ route('admin.employee.list') }}">Employees Management</a>
            <a class="collapse-item" href="{{ route('admin.time-attendance-reports.list') }}">Time And Attendance</a>
            <a class="collapse-item" href="{{ route('admin.payroll.list') }}">Payroll</a>
            <a class="collapse-item" href="{{ route('admin.talent_acquisitions.list') }}">Talent Acquisition</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventory"
        aria-expanded="true" aria-controls="collapseInventory">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Inventory</span>
    </a>
    <div id="collapseInventory" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Inventory Management:</h6>
            <a class="collapse-item" href="{{ route('admin.supplier-list') }}">Supplier Management</a>
            <a class="collapse-item" href="{{ route('admin.product-list') }}">Product Management</a>
            <a class="collapse-item" href="{{ route('admin.procurement-list') }}">Procurement Management</a>
            {{-- <a class="collapse-item" href="utilities-border.html">Inventory Management</a> --}}
            {{-- <a class="collapse-item" href="utilities-animation.html">Order FulFilement</a> --}}
            {{-- <a class="collapse-item" href="utilities-other.html">Warehouse Management</a> --}}
        </div>
    </div>
</li>
<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCRM"
        aria-expanded="true" aria-controls="collapseCRM">
        <i class="fas fa-fw fa-wrench"></i>
        <span>CRM</span>
    </a>
    <div id="collapseCRM" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">CRM Management:</h6>
            <a class="collapse-item" href="{{ route('admin.company-list') }}">Comapny Management</a>
            <a class="collapse-item" href="{{ route('admin.customer-list') }}">Customer Management</a>
            <a class="collapse-item" href="{{ route('admin.crm-salesServices-list') }}">Sales services Management</a>

        </div>
    </div>


</li>


<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccounting"
        aria-expanded="true" aria-controls="collapseAccounting">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Finance and Accounting</span>
    </a>
    <div id="collapseAccounting" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Finance & Accounting:</h6>
            <a class="collapse-item" href="{{ route('admin.sales.automation-list') }}">Sales Automation</a>
            <a class="collapse-item" href="{{ route('admin.customer.service-list') }}">Customer Service</a>
            <a class="collapse-item" href="{{ route('admin.analytics-list') }}">Analytics</a>
        </div>
    </div>
</li>

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
        <span>Business Intelligence</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Business Intelligence:</h6>
            <a class="collapse-item" href="{{route('admin.forecast')}}">Business Forecasting</a>
            <a class="collapse-item" href="{{route('product_base_analysis')}}">Product Base Analysis</a>
            <a class="collapse-item" href="forgot-password.html">Business Analysis</a>
            <a class="collapse-item" href="forgot-password.html">Collaboration tools</a>
            <a class="collapse-item" href="forgot-password.html">Project Analytics</a>
            <a class="collapse-item" href="forgot-password.html">ERP Modules </a>
            <!-- <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a> -->
        </div>
    </div>
</li>

<!-- Nav Item - Charts -->

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->