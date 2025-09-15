@extends('layouts.application.layout_application')
@section('PageTitle', 'Stand Düzenleme')

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
                    <div class="ribbon-label bg-warning fs-6" style="padding: 10px 15px;"><span class="d-flex text-white fw-bolder fs-6">Stand Bilgileri</span></div>
                    <h3 class="card-title"></h3>
                    <div class="card-toolbar"></div>
                </div>
                <div class="card-body">
                    <form action="{{ route('Stands.Update', $stand->id) }}" id="editForm" enctype="multipart/form-data" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-6">
                                <label for="input-serial_no" class="required form-label">Stand Seri Numarası</label>
                                <input type="text" name="input-serial_no" id="input-serial_no" class="form-control @error('input-serial_no') is-invalid error-input @enderror" placeholder="Stand Seri Numarası Giriniz" maxlength="50" value="{{ old('input-serial_no', $stand->serial_no) }}"/>
                                @if ($errors->has('input-serial_no'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-serial_no') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <label for="input-is_active" class="required form-label">Durumu</label>
                                <select class="form-select @error('input-is_active') is-invalid error-input @enderror" name="input-is_active" id="input-is_active" data-control="select2" data-placeholder="Seçim Yapınız" data-hide-search="true">
                                    <option></option>
                                    <option value="1" {{ old('input-is_active', $stand->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('input-is_active', $stand->is_active) == '0' ? 'selected' : '' }}>Pasif</option>
                                </select>
                                @if ($errors->has('input-is_active'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-is_active') }}
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
                    <a href="{{ route('Stands.Index') }}" class="btn btn-light-danger btn-sm ms-2">Geri Dön</a>
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
