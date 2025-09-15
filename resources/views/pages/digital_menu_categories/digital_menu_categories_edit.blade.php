@extends('layouts.application.layout_application')
@section('PageTitle', 'Menü Kategorisi Düzenleme')

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
                    <div class="ribbon-label bg-warning fs-6" style="padding: 10px 15px;"><span class="d-flex text-white fw-bolder fs-6">Menü Kategorisi Bilgileri</span></div>
                    <h3 class="card-title"></h3>
                    <div class="card-toolbar"></div>
                </div>
                <div class="card-body">
                    <form action="{{ route('DigitalMenuCategories.Update', $digitalMenuCategory->id) }}" id="editForm" enctype="multipart/form-data" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <label for="input-category_name" class="required form-label">Kategori Adı</label>
                                <input type="text" name="input-category_name" id="input-category_name" class="form-control @error('input-category_name') is-invalid error-input @enderror" placeholder="Kategori Adı Giriniz" maxlength="50" value="{{ old('input-category_name', $digitalMenuCategory->category_name) }}"/>
                                @if ($errors->has('input-category_name'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-category_name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <label for="input-category_description" class="required form-label">Kategori Açıklaması</label>
                                <input type="text" name="input-category_description" id="input-category_description" class="form-control @error('input-category_description') is-invalid error-input @enderror" placeholder="Kategori Açıklaması Giriniz" maxlength="50" value="{{ old('input-category_description', $digitalMenuCategory->category_description) }}"/>
                                @if ($errors->has('input-category_description'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-category_description') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-12">
                                <label for="input-is_active" class="required form-label">Durumu</label>
                                <select class="form-select @error('input-is_active') is-invalid error-input @enderror" name="input-is_active" id="input-is_active" data-control="select2" data-placeholder="Seçim Yapınız" data-hide-search="true">
                                    <option></option>
                                    <option value="1" {{ old('input-is_active', $digitalMenuCategory->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('input-is_active', $digitalMenuCategory->is_active) == '0' ? 'selected' : '' }}>Pasif</option>
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
                    <a href="{{ route('DigitalMenuCategories.Index') }}" class="btn btn-light-danger btn-sm ms-2">Geri Dön</a>
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
