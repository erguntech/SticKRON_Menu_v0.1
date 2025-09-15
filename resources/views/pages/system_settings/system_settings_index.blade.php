@extends('layouts.application.layout_application')
@section('PageTitle', 'Sistem Ayarları')

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
                    <div class="ribbon-label bg-warning fs-6" style="padding: 10px 15px;"><span class="d-flex text-white fw-bolder fs-6">Sistem Ayarları Bilgileri</span></div>
                    <h3 class="card-title"></h3>
                    <div class="card-toolbar"></div>
                </div>
                <div class="card-body">
                    <form action="{{ route('Settings.System.Update') }}" id="editForm" enctype="multipart/form-data" method="POST" autocomplete="off">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-12">
                                <label for="input-app_maintenance_mode" class="required form-label">Bakım Çalışması</label>
                                <select class="form-select @error('input-app_maintenance_mode') is-invalid error-input @enderror" name="input-app_maintenance_mode" id="input-app_maintenance_mode" data-control="select2" data-placeholder="Seçim Yapınız" data-hide-search="true">
                                    <option></option>
                                    <option value="1" {{ old('input-app_maintenance_mode', settings()->get('app_maintenance_mode')) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('input-app_maintenance_mode', settings()->get('app_maintenance_mode')) == '0' ? 'selected' : '' }}>Pasif</option>
                                </select>
                                @if ($errors->has('input-app_maintenance_mode'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-app_maintenance_mode') }}
                                    </div>
                                @endif
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
