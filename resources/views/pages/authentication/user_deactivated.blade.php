@extends('layouts.error_pages.layout_error_pages')
@section('PageTitle', 'Opps')

@section('PageVendorCSS')

@endsection

@section('PageCustomCSS')
    <style>
        body { background-image: url('{{ asset('assets/media/auth/bg3-dark.jpg') }}'); }
    </style>
@endsection

@section('PageContent')
    <div class="d-flex flex-column flex-center flex-column-fluid">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-center text-center p-10">
            <!--begin::Wrapper-->
            <div class="card card-flush w-lg-650px py-5">
                <div class="card-body py-15 py-lg-20">
                    <!--begin::Logo-->
                    <div class="mb-14">
                        <img alt="Logo" src="{{ asset('assets/media/logos/login_logo_dark-01.svg') }}" class="h-125px h-lg-125px mb-2"/>
                    </div>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="fw-bolder text-gray-900 mb-5">Hesabınız Devre Dışı!</h1>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="fw-semibold fs-6 text-gray-500 mb-8">Bu durumun hata olduğunu düşünüyorsanız lütfen bizimle irtibata geçiniz.</div>
                    <!--end::Text-->
                    <!--begin::Link-->
                    <div class="mb-11">
                        <a href="{{ route('Dashboards.Index') }}" class="btn btn-sm btn-primary">Başlangıç</a>
                    </div>
                    <!--end::Link-->
                </div>
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
@endsection

@section('PageVendorJS')

@endsection

@section('PageCustomJS')

@endsection
