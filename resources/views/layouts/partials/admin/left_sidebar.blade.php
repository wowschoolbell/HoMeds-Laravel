<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <!-- begin sidebar branding-->
        <!-- <img class="admin-brand-logo" src="{{ asset('theme/light/img/GAF-CW-logo.jpeg') }}" width="40" alt="atmos Logo"> -->
        <span class="admin-brand-content" style="display: flex; justify-content: center; align-items: center;margin-left: auto;">
            <a href="{{ route('home') }}">  HoMEds </a>
        </span>
        <!-- end sidebar branding-->
        <div class="ml-auto">
            <!-- sidebar pin-->
            <!-- <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle" id="pinToggle"></a> -->
            <!-- sidebar close for mobile device-->
            <a href="#" class="admin-close-sidebar"></a>
        </div>
    </div>
    <div class="admin-sidebar-wrapper js-scrollbar" style="background-color:#B57EDC;">
        <!-- Menu List Begins-->
        <ul class="menu" id="sidebarnav">
            <!--list item begins-->
            <li class="parent-li menu-item">
                <a href="{{ route('home') }}" class="menu-link">
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-monitor-dashboard"></i>
                        </span>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center; color:white;">
                        <span class="menu-name">
                            Dashboard
                        </span>
                    </div>
                </a>
            </li>
            <li class="parent-li menu-item">
                <a href="{{ route('admin.configurations.index') }}" class="menu-link menu-container">
                    <div class="menu-item">
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-settings" style="color: white !important;"></i>
                            </span>
                        </div>
                        <div style="display: flex; justify-content: center; align-items: center; color:white;">
                            <span class="menu-name">
                                Config
                            </span>
                        </div>
                    </div>
                </a>
            </li>
            <li class="parent-li menu-item">
                <a href="{{ route('admin.store.index') }}" class="menu-link menu-container">
                    <div class="menu-item">
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi mdi-store"></i>
                            </span>
                        </div>
                        <div style="display: flex; justify-content: center; align-items: center; color:white;">
                            <span class="menu-name">
                                Store
                            </span>
                        </div>
                    </div>
                </a>
            </li>
            <li class="parent-li menu-item">
                <a href="{{ route('admin.delivery_partner.index') }}" class="menu-link menu-container">
                    <div class="menu-item">
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-truck-delivery" style="color: white !important;"></i>
                            </span>
                        </div>
                        <div style="display: flex; justify-content: center; align-items: center; color:white;">
                            <span class="menu-name">
                                Pilot
                            </span>
                        </div>
                    </div>
                </a>
            </li>
             <li class="parent-li menu-item">
                <a href="{{ route('admin.customers.index') }}" class="menu-link menu-container">
                    <div class="menu-item">
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-account-multiple" style="color: white !important;"></i>
                            </span>
                        </div>
                        <div style="display: flex; justify-content: center; align-items: center; color:white;">
                            <span class="menu-name">
                                Customers
                            </span>
                        </div>
                    </div>
                </a>
            </li>

            <!-- <li class="parent-li menu-item">
                <a href="{{ route('admin.status.index') }}" class="menu-link menu-container">
                    <div class="menu-item">
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi mdi-store"></i>
                            </span>
                        </div>
                        <div style="display: flex; justify-content: center; align-items: center; color:white;">
                            <span class="menu-name">
                                Package
                            </span>
                        </div>
                    </div>
                </a>
            </li> -->
            <!-- <li class="parent-li menu-item">
                <a href="" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Stores
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-store"></i>
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="{{ route('admin.app_status.index') }}" class="menu-link">
                            <span class="menu-label">
                                <span class="menu-name">App Status</span>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.store.index') }}" class="menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Lists</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li> -->
        </ul>
    </div>
    <style>
    </style>
</aside>
