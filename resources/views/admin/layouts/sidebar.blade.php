 <!-- BEGIN: Main Menu-->
 <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{ route('admin.dashboard') }}"><span class="brand-logo">
                        </span>
                    <h2 class="brand-text">{{ env('APP_NAME') }}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ (request()->is(env('ADMIN_PREFIX').'/dashboard')) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}"><i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>
            <li class="nav-item has-sub {{ (request()->is(env('ADMIN_PREFIX').'/category*') || request()->is(env('ADMIN_PREFIX').'/product*')) ? 'open' : '' }}" style="">
                <a class="d-flex align-items-center" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span class="menu-title text-truncate" data-i18n="Question">Management</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->is(env('ADMIN_PREFIX').'/category*')) ?'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.category.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                            <span class="menu-item text-truncate" data-i18n="Category">Category</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is(env('ADMIN_PREFIX').'/product*')) ?'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.product.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                            <span class="menu-item text-truncate" data-i18n="eCommerce">Product</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is(env('ADMIN_PREFIX').'/app_banner*')) ?'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.app_banner') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                            <span class="menu-item text-truncate" data-i18n="eCommerce">App Banner</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
