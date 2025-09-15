@extends('layouts.error_pages.layout_error_pages')
@section('PageTitle', 'Şifre Sıfırlama')

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
            <div class="card card-flush w-lg-500px py-5">
                <div class="card-body py-15 py-lg-20">
                    <form class="form w-100" id="reset_password_form" novalidate="novalidate" id="kt_sign_in_form" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="text-center mb-11">
                            <img alt="Logo" src="{{ asset('assets/media/logos/login_logo_dark-01.svg') }}" class="h-125px h-lg-125px mb-2"/>
                            <div class="text-gray-500 fw-semibold fs-6">Lütfen e-posta adresinizi ve yeni şifrenizi girerek formu onaylayınız.</div>
                        </div>
                        <div class="separator separator-content my-14">
                            <span class="w-125px text-gray-500 fw-semibold fs-7">@</span>
                        </div>
                        <div class="fv-row mb-3">
                            <input type="text" placeholder="E-Posta Adresi" name="email" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid error-input @enderror" />
                            @if ($errors->has('email'))
                                <div class="text-danger mt-2">@ {{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="fv-row mb-3">
                            <input type="password" placeholder="Şifre" name="password" autocomplete="off" class="form-control bg-transparent @error('password') is-invalid error-input @enderror" />
                            @if ($errors->has('password'))
                                <div class="text-danger mt-2">@ {{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="fv-row mb-3">
                            <input type="password"  placeholder="Şifre (Tekrar)" name="password_confirmation" autocomplete="off"class="form-control bg-transparent @error('password_confirmation') is-invalid error-input @enderror"/>
                            @if ($errors->has('password_confirmation'))
                                <div class="text-danger mt-2">@ {{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                <div class="alert alert-success text-center p-3">
                                    <span class="text-center">{{ session('status') }}</span>
                                </div>
                            </div>
                        @endif

                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-3" style="display: none;"></div>
                        <div class="d-grid mb-4">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-warning">
                                <span class="indicator-label">Güncelle</span>
                                <span class="indicator-progress">Bekleyiniz...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                        <div class="text-warning text-center fw-semibold fs-6 mb-4">
                            <a href="/login" class="text-primary">Geri Dön <i class="fas fa-rotate-left"></i></a>
                        </div>
                        <div class="text-gray-500 text-center fw-semibold fs-6">
                            <span>{{ Settings::get('app_title') }} - {{ Settings::get('app_version') }}</span>
                        </div>
                    </form>
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
