@extends('layouts.application.layout_application')
@section('PageTitle', 'Dijital Menu Ayarları')

@section('PageVendorCSS')

@endsection

@section('PageCustomCSS')

@endsection

@section('Breadcrumb')

@endsection

@section('PageContent')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-12">

            @if (session('result'))
                <div class="mb-4">
                    @include('components.alert', $data = ['alert_type' => session('result'), 'alert_title' => session('title'), 'alert_content' => session('content')])
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header ribbon ribbon-start ribbon-clip">
                    <div class="ribbon-label bg-warning fs-6" style="padding: 10px 15px;"><span class="d-flex text-white fw-bolder fs-6">Dijital Menu Ayarları Bilgileri</span></div>
                    <h3 class="card-title"></h3>
                    <div class="card-toolbar"></div>
                </div>
                <div class="card-body">
                    <form action="{{ route('Settings.Store.Update') }}" id="editForm" enctype="multipart/form-data" method="POST" autocomplete="off">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-12">
                                <p class="required form-label">@ Dijital Menü QR Kodu</p>
                                <div class="symbol mt-4">
                                    @php
                                        $qrUrl = asset('uploads/qrcodes/'.\Illuminate\Support\Facades\Auth::user()->linkedClient->id.'.svg') . '?v=' . optional(\Illuminate\Support\Facades\Auth::user()->linkedClient->updated_at)->timestamp;
                                    @endphp

                                    <div class="symbol-label fs-2 fw-semibold bg-white text-inverse-info p-2"
                                         style="width:192px;height:192px;background:url('{{ $qrUrl }}') center/contain no-repeat;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="separator border-2 my-10"></div>
                    <button type="submit" class="btn btn-warning btn-sm" form="editForm">
                        <span class="indicator-label">Düzenle</span>
                        <span class="indicator-progress">Bekleyiniz... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('PageVendorJS')

@endsection

@section('PageCustomJS')

@endsection

@section('PageModals')

@endsection
