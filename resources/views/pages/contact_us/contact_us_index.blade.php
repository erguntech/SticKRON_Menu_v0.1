@extends('layouts.application.layout_application')
@section('PageTitle', 'Bize Ulaşın')

@section('PageVendorCSS')

@endsection

@section('PageCustomCSS')

@endsection

@section('Breadcrumb')

@endsection

@section('PageContent')
    <div class="row g-5 g-xl-8 mb-5">
        <div class="col-md-12">
            @if (session('result'))
                @include('components.alert', $data = ['alert_type' => session('result'), 'alert_title' => session('title'), 'alert_content' => session('content')])
            @endif
            <div class="card shadow-sm">
                <div class="card-header ribbon ribbon-start ribbon-clip">
                    <div class="ribbon-label bg-success fs-6" style="padding: 10px 15px;"><span class="d-flex text-white fw-bolder fs-6">İletişim Formu</span></div>
                    <h3 class="card-title"></h3>
                    <div class="card-toolbar"></div>
                </div>

                <div class="card-body">
                    <form action="{{ route('Contact.SendMessage') }}" id="contactForm" enctype="multipart/form-data" method="POST" autocomplete="off">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-12">
                                <label for="input-message_content" class="required form-label">Mesajınız</label>
                                <textarea name="input-message_content" id="input-message_content" class="form-control @error('input-message_content') is-invalid error-input @enderror" rows="4" placeholder="Mesajınızı Giriniz"></textarea>
                                @if ($errors->has('input-message_content'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-message_content') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="separator border-2 my-10"></div>

                    <button type="button" class="btn btn-success btn-sm" onclick="formSubmit(this)">
                        <span class="indicator-label">Onayla</span>
                        <span class="indicator-progress">Bekleyiniz... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--begin::Row-->
    <div class="row g-5 mb-5">
        <!--begin::Col-->
        <div class="col-sm-6">
            <!--begin::Phone-->
            <div class="card card-rounded d-flex flex-column flex-center flex-center p-10 h-100">
                <!--begin::Icon-->
                <i class="ki-duotone ki-briefcase fs-3tx text-primary">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <!--end::Icon-->
                <!--begin::Subtitle-->
                <h1 class="text-gray-900 fw-bold my-5 fs-2">Konuşarak Halledebiliriz</h1>
                <!--end::Subtitle-->
                <!--begin::Number-->
                <div class="text-gray-700 fw-semibold fs-4">{{ Settings::get('app_contact_phone') }}</div>
                <!--end::Number-->
            </div>
            <!--end::Phone-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-sm-6">
            <!--begin::Address-->
            <div class="text-center card card-rounded d-flex flex-column flex-center p-10 h-100">
                <!--begin::Icon-->
                <i class="ki-duotone ki-geolocation fs-3tx text-primary">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <!--end::Icon-->
                <!--begin::Subtitle-->
                <h1 class="text-gray-900 fw-bold my-5 fs-2">Ofisimize Bekliyoruz</h1>
                <!--end::Subtitle-->
                <!--begin::Description-->
                <div class="text-gray-700 fs-3 fw-semibold fs-4">{{ Settings::get('app_company_address') }}</div>
                <!--end::Description-->
            </div>
            <!--end::Address-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Card-->
    <div class="card mb-4 bg-light text-center">
        <!--begin::Body-->
        <div class="card-body py-12">
            <!--begin::Icon-->
            <a href="https://wa.me/{{ Settings::get('app_contact_whatsapp') }}" class="mx-4" target="_blank">
                <img src="{{ asset('assets/media/svg/brand-logos/whatsapp.svg') }}" class="h-30px my-2" alt="" />
            </a>
            <!--end::Icon-->
            <!--begin::Icon-->
            <a href="{{ Settings::get('app_social_instagram_address') }}" class="mx-4" target="_blank">
                <img src="{{ asset('assets/media/svg/brand-logos/instagram-2-1.svg') }}" class="h-30px my-2" alt="" />
            </a>
            <!--end::Icon-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card-->
@endsection

@section('PageVendorJS')

@endsection

@section('PageCustomJS')
    <script type="text/javascript">
        function formSubmit(submitBtn) {
            Swal.fire({
                title: 'Mesajınız Gönderilecek! Emin Misiniz?',
                text: 'Bu işlem geri alınamaz.',
                icon: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonText: 'Onayla!',
                cancelButtonText: 'Geri Dön',
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-warning ml-1',
                    title: 'text-white'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.isConfirmed) {
                    submitBtn.setAttribute("data-kt-indicator", "on");
                    $("#contactForm").submit();
                }
            });
        }
    </script>
@endsection

@section('PageModals')

@endsection
