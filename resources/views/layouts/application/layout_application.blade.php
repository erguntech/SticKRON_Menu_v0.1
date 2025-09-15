<!DOCTYPE html>
<!--
    Author: ErgunTech.X
    Product Name: Relicwise Admin Center v0.3
    Website: {{ Settings::get('app_contact_domain') }}
    Contact: {{ Settings::get('app_contact_email') }}
-->
<html lang="tr">
<head>
    <title>{{ Settings::get('app_alias') }} | @yield('PageTitle')</title>
    @include('layouts.application.partials.partial_meta')
    @include('layouts.application.partials.partial_css')
    @yield('PageVendorCSS')
    @yield('PageCustomCSS')
</head>
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        @include('layouts.application.partials.partial_theme_settings')
        @include('layouts.application.partials.partial_app_header')
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            @include('layouts.application.partials.partial_app_sidebar')
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <div id="kt_app_content_container" class="app-container container-fluid mt-6">
                            @yield('PageContent')
                        </div>
                    </div>
                </div>
                @include('layouts.application.partials.partial_app_footer')
            </div>
        </div>
    </div>
</div>

@include('layouts.application.partials.partial_scrolltop')

<form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
</form>

@include('layouts.application.partials.partial_js')
@yield('PageVendorJS')
@yield('PageCustomJS')
</body>
@yield('PageModals')
</html>
