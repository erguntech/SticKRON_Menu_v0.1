@extends('layouts.application.layout_application')
@section('PageTitle', 'Bayi Düzenleme')

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
                    <div class="ribbon-label bg-warning fs-6" style="padding: 10px 15px;"><span class="d-flex text-white fw-bolder fs-6">Bayi Bilgileri</span></div>
                    <h3 class="card-title"></h3>
                    <div class="card-toolbar"></div>
                </div>
                <div class="card-body">
                    <form action="{{ route('Clients.Update', $client->id) }}" id="editForm" enctype="multipart/form-data" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <label for="input-email" class="form-label">E-Posta Adresi</label>
                                <input type="email" name="input-email" id="input-email" class="form-control" placeholder="" maxlength="50" value="{{ old('input-email', $user->email) }}" disabled/>
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-6">
                                <label for="input-first_name" class="required form-label">Adı</label>
                                <input type="text" name="input-first_name" id="input-first_name" class="form-control @error('input-first_name') is-invalid error-input @enderror" placeholder="Adı Giriniz" maxlength="50" value="{{ old('input-first_name', $user->first_name) }}"/>
                                @if ($errors->has('input-first_name'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-first_name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <label for="input-last_name" class="required form-label">Soyadı</label>
                                <input type="text" name="input-last_name" id="input-last_name" class="form-control @error('input-last_name') is-invalid error-input @enderror" placeholder="Soyadı Giriniz" maxlength="50" value="{{ old('input-last_name', $user->last_name) }}"/>
                                @if ($errors->has('input-last_name'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-last_name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-6">
                                <label for="input-is_active" class="required form-label">Durumu</label>
                                <select class="form-select @error('input-is_active') is-invalid error-input @enderror" name="input-is_active" id="input-is_active" data-control="select2" data-placeholder="Seçim Yapınız" data-hide-search="true">
                                    <option></option>
                                    <option value="1" {{ old('input-is_active', $user->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('input-is_active', $user->is_active) == '0' ? 'selected' : '' }}>Pasif</option>
                                </select>
                                @if ($errors->has('input-is_active'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-is_active') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <label for="input-company_name" class="required form-label">İşletme Adı</label>
                                <input type="text" name="input-company_name" id="input-company_name" class="form-control @error('input-company_name') is-invalid error-input @enderror" placeholder="İşletme Adı Giriniz" maxlength="500" value="{{ old('input-company_name', $client->company_name) }}"/>
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
                                <input type="text" name="input-company_address" id="input-company_address" class="form-control @error('input-company_address') is-invalid error-input @enderror" placeholder="İşletme Adresi Giriniz" maxlength="500" value="{{ old('input-company_address', $client->company_address) }}"/>
                                @if ($errors->has('input-company_address'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-company_address') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <label for="input-company_phone" class="required form-label">Telefon Numarası</label>
                                <input type="text" name="input-company_phone" id="input-company_phone" class="form-control @error('input-company_phone') is-invalid error-input @enderror" placeholder="İşletme Telefonu Giriniz" maxlength="500" value="{{ old('input-company_phone', $client->company_phone) }}"/>
                                @if ($errors->has('input-company_phone'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-company_phone') }}
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
                    <a href="{{ route('Clients.Index') }}" class="btn btn-light-danger btn-sm ms-2">Geri Dön</a>
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
