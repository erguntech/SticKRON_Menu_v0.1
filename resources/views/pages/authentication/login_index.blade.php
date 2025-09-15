@extends('layouts.authentication.layout_authentication')
@section('PageTitle', 'Giriş')

@section('PageVendorCSS')

@endsection

@section('PageCustomCSS')

@endsection

@section('PageContent')
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-lg-500px p-10">
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="{{ route('login') }}" method="POST">
                    @csrf
                        <div class="text-center mb-11">
                            <img alt="Logo" src="{{ asset('assets/media/logos/login_logo_dark-01.svg') }}" class="h-125px h-lg-125px mb-2"/>

                            <div class="text-gray-500 fw-semibold fs-6">Lütfen size sağlanan kullanıcı bilgileri ile sisteme giriş yapınız.</div>
                        </div>
                        <div class="separator separator-content my-14">
                            <span class="w-125px text-gray-500 fw-semibold fs-7">@</span>
                        </div>
                        <div class="fv-row mb-6">
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

                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                <div class="alert alert-success text-center p-3">
                                    <span class="text-center">{{ session('status') }}</span>
                                </div>
                            </div>
                        @endif

                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-3" style="display: none;"></div>
                        <div class="d-grid mb-4">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <span class="indicator-label">Giriş Yap</span>
                                <span class="indicator-progress">Bekleyiniz...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                        <div class="text-warning text-center fw-semibold fs-6 mb-4">
                            <a href="/forgot-password" class="text-primary">Şifremi Unuttum <i class="fas fa-key"></i></a>
                        </div>
                        <div class="text-gray-500 text-center fw-semibold fs-6">
                            <span>{{ Settings::get('app_title') }} - {{ Settings::get('app_version') }}</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ asset('assets/media/app/login_bg.png') }})"></div>
    </div>
@endsection

@section('PageVendorJS')

@endsection

@section('PageCustomJS')

@endsection

@section('PageModals')

@endsection
