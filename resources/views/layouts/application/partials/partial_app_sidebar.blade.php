<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="{{ route('Dashboards.Index') }}">
            <img alt="Logo" src="{{ asset('assets/media/logos/default-dark.svg') }}" class="h-55px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('assets/media/logos/default-small.svg') }}" class="h-20px app-sidebar-logo-minimize" />
        </a>
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>

    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y overflow-hidden my-5 mx-3" data-kt-scroll="false" data-kt-scroll-activate="false" data-kt-scroll-height="false" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    <div class="menu-item">
                        <a class="menu-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{ route('Dashboards.Index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-home fs-2"></i>
                            </span>
                            <span class="menu-title">Genel Bakış</span>
                        </a>
                    </div>

                    @if(Auth()->user()->can('Müşteri Yönetimi Kullanım İzni'))
                    <div class="menu-item">
                        <a class="menu-link {{ (request()->is('clients', 'clients/*', 'clients/create', 'clients/*/edit')) ? 'active' : '' }}" href="{{ route('Clients.Index') }}">
                            <span class="menu-icon">
                                <i class="ki-solid ki-profile-user fs-2"></i>
                            </span>
                            <span class="menu-title">Müşteri Yönetimi</span>
                        </a>
                    </div>
                    @endif

                    @if(Auth()->user()->can('Dijital Menü Yönetimi Kullanım İzni'))
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ (request()->is('contents', 'contents/create', 'contents/*/edit', 'sorting/contents', 'categories', 'categories/create', 'categories/*/edit', 'sorting/categories', 'campaigns', 'campaigns/create', 'campaigns/*/edit', 'sorting/campaigns')) ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-solid ki-text-circle fs-2"></i>
                            </span>
                            <span class="menu-title">Dijital Menü Yönetimi</span>
                            <span class="menu-arrow"></span>
                        </span>
                            <div class="menu-sub menu-sub-accordion">
                                <div class="menu-item">
                                    <a class="menu-link {{ (request()->is('contents', 'contents/create', 'contents/*/edit', 'sorting/contents')) ? 'active' : '' }}" href="{{ route('DigitalMenuContents.Index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">Menü İçerikleri</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{ (request()->is('categories', 'categories/create', 'categories/*/edit', 'sorting/categories')) ? 'active' : '' }}" href="{{ route('DigitalMenuCategories.Index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">Menü Kategorileri</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{ (request()->is('campaigns', 'campaigns/create', 'campaigns/*/edit', 'sorting/campaigns')) ? 'active' : '' }}" href="{{ route('DigitalMenuCampaigns.Index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">Kampanyalar</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(Auth()->user()->can('Sistem Ayarlarını Kullanım İzni') or Auth()->user()->can('Dijital Menü Ayarlarını Kullanım İzni'))
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ (request()->is('settings/system', 'settings/store')) ? 'here show' : '' }}">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-solid ki-gear fs-2"></i>
                                </span>
                                <span class="menu-title">Ayarlar</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion">
                                @if(Auth()->user()->can('Dijital Menü Ayarlarını Kullanım İzni'))
                                    <div class="menu-item">
                                        <a class="menu-link {{ (request()->is('settings/store')) ? 'active' : '' }}" href="{{ route('Settings.Store.Index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Dijital Menü Ayarları</span>
                                        </a>
                                    </div>
                                @endif
                                @if(Auth()->user()->can('Sistem Ayarlarını Kullanım İzni'))
                                    <div class="menu-item">
                                        <a class="menu-link {{ (request()->is('settings/system')) ? 'active' : '' }}" href="{{ route('Settings.System.Index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Sistem Ayarları</span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="menu-icon">
                                <i class="ki-solid ki-exit-right fs-2"></i>
                            </span>
                            <span class="menu-title">Güvenli Çıkış</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Auth()->user()->can('Dijital Menü Ayarlarını Kullanım İzni'))
        <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
            <a href="{{ url('').'/menu/'.\Illuminate\Support\Facades\Auth::user()->linkedClient->qr_menu_content }}" class="btn btn-flex flex-center btn-success overflow-hidden text-nowrap px-0 h-40px w-100" target="_blank">
                <span class="btn-label">Dijital Menü Görüntüle</span>
            </a>
        </div>
    @endif
</div>
