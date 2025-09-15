<div id="kt_app_footer" class="app-footer">
    <!--begin::Footer container-->
    <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
        <!--begin::Copyright-->
        <div class="text-gray-900 order-2 order-md-1">
            <span class="text-muted fw-semibold me-1">2024&copy;</span>
            <a href="{{ Settings::get('app_domain') }}" target="_blank" class="text-gray-800 text-hover-primary">{{ Settings::get('app_name') }} {{ Settings::get('app_version') }}</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
            <li class="menu-item">
                <a href="{{ Settings::get('app_contact_domain') }}" target="_blank" class="menu-link px-2">Hakkımızda</a>
            </li>
            <li class="menu-item">
                <a href="{{ route('Contact.Index') }}" class="menu-link px-2">Bize Ulaşın</a>
            </li>
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Footer container-->
</div>
