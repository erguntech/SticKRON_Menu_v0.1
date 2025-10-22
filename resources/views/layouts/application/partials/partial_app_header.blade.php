<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
        <!--begin::Sidebar mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <!--end::Sidebar mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ route('Dashboards.Index') }}" class="d-lg-none">
                <img alt="Logo" src="{{ asset('assets/media/logos/default-small.svg') }}" class="h-30px" />
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Header wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <!--begin::Menu wrapper-->
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <span class="page-heading d-flex text-gray-700 fw-bold fs-6 align-items-center my-0">
                    {{ Settings::get('app_alias') }} | @yield('PageTitle')
                </span>
            </div>
            <div class="app-navbar flex-shrink-0">
                <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <img src="{{ asset('assets/media/avatars/blank.png') }}" class="rounded-3" alt="user" />
                    </div>
                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="{{ asset('assets/media/avatars/blank.png') }}" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">
                                        {{ Auth::user()->getUserFullName() }}
                                    </div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        @if(Auth()->user()->can('Dijital Menü Ayarlarını Kullanım İzni'))
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="{{ url('').'/menu/'.\Illuminate\Support\Facades\Auth::user()->linkedClient->qr_menu_content }}" class="menu-link px-5" target="_blank"><span class="bullet bg-primary me-2"></span>Dijital Menü'yü Görüntüle</a>
                        </div>
                        <!--end::Menu item-->
                        @endif
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == 1)
                                <a href="{{ route('Settings.System.Index') }}" class="menu-link px-5"><span class="bullet bg-primary me-2"></span> Sistem Ayarları</a>
                            @else
                                <a href="{{ route('Settings.Store.Index') }}" class="menu-link px-5"><span class="bullet bg-primary me-2"></span> Dijital Menü Ayarları</a>
                            @endif

                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link px-5"><span class="bullet bg-primary me-2"></span> Güvenli Çıkış</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->
                    <!--end::Menu wrapper-->
                </div>
            </div>
        </div>
    </div>
</div>
