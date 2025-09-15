@extends('layouts.application.layout_application')
@section('PageTitle', 'Müşteri Bilgileri')

@section('PageVendorCSS')

@endsection

@section('PageCustomCSS')

@endsection

@section('Breadcrumb')

@endsection

@section('PageContent')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-header ribbon ribbon-start ribbon-clip">
                    <div class="ribbon-label bg-success fs-6" style="padding: 10px 15px;"><span class="d-flex text-white fw-bolder fs-6">Müşteri Bilgileri</span></div>
                    <h3 class="card-title"></h3>
                    <div class="card-toolbar"></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="input-email" class="form-label">E-Posta Adresi</label>
                            <input type="email" name="input-email" id="input-email" class="form-control" maxlength="50" value="{{ $user->email }}" disabled/>
                        </div>
                    </div>
                    <div class="row mt-6">
                        <div class="col-6">
                            <label for="input-first_name" class="required form-label">Adı</label>
                            <input type="text" name="input-first_name" id="input-first_name" class="form-control" maxlength="50" value="{{ $user->first_name }}" disabled/>
                        </div>
                        <div class="col-6">
                            <label for="input-last_name" class="required form-label">Soyadı</label>
                            <input type="text" name="input-last_name" id="input-last_name" class="form-control" maxlength="50" value="{{ $user->last_name }}" disabled/>
                        </div>
                    </div>
                    <div class="row mt-6">
                        <div class="col-6">
                            <label for="input-is_active" class="required form-label">Durumu</label>
                            <select class="form-select" name="input-is_active" id="input-is_active" data-control="select2" data-placeholder="Seçim Yapınız" data-hide-search="true" disabled>
                                <option></option>
                                <option value="1" {{ $user->is_active == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ $user->is_active == '0' ? 'selected' : '' }}>Pasif</option>
                            </select>
                            @if ($errors->has('input-is_active'))
                                <div class="invalid-feedback">
                                    @ {{ $errors->first('input-is_active') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-6">
                            <label for="input-company_name" class="required form-label">İşletme Adı</label>
                            <input type="text" name="input-company_name" id="input-company_name" class="form-control" maxlength="500" value="{{ $client->company_name }}" disabled/>
                            @if ($errors->has('input-company_name'))
                                <div class="invalid-feedback">
                                    @ {{ $errors->first('input-company_name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-6">
                        <div class="col-6">
                            <label for="input-company_address" class="required form-label">Adresi</label>
                            <input type="text" name="input-company_address" id="input-company_address" class="form-control" maxlength="500" value="{{ $client->company_address }}" disabled/>
                        </div>
                        <div class="col-6">
                            <label for="input-company_phone" class="required form-label">Telefon Numarası</label>
                            <input type="text" name="input-company_phone" id="input-company_phone" class="form-control" maxlength="500" value="{{ $client->company_phone }}" disabled/>
                        </div>
                    </div>
                    <div class="row mt-6">
                        <div class="col-12">
                            <p class="form-label">@ Dijital Menü QR Kodu</p>
                            <div class="symbol mt-2">
                                @php
                                    $qrUrl = asset('uploads/qrcodes/'.$client->id.'.svg') . '?v=' . optional($client->updated_at)->timestamp;
                                @endphp

                                <div class="symbol-label fs-2 fw-semibold bg-white text-inverse-info p-2"
                                     style="width:192px;height:192px;background:url('{{ $qrUrl }}') center/contain no-repeat;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-6">
                        <div class="col-12">
                            <p class="form-label">@ Dijital Menü Web Adresi</p>
                            <a href="{{ url('').'/menu/'.$client->qr_menu_content }}" target="_blank">
                                {{ url('').'/menu/'.$client->qr_menu_content }}
                            </a>
                        </div>
                    </div>
                    <div class="separator border-2 my-10"></div>
                    <a href="{{ route('Clients.Index') }}" class="btn btn-light-danger btn-sm">Geri Dön</a>
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
