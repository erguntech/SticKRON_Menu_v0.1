@extends('layouts.application.layout_application')
@section('PageTitle', 'Kampanya Düzenleme')

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
                    <div class="ribbon-label bg-warning fs-6" style="padding: 10px 15px;"><span class="d-flex text-white fw-bolder fs-6">Kampanya Bilgileri</span></div>
                    <h3 class="card-title"></h3>
                    <div class="card-toolbar"></div>
                </div>
                <div class="card-body">
                    <form action="{{ route('DigitalMenuContents.Update', $digitalMenuContent->id) }}" id="editForm" enctype="multipart/form-data" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-4">
                                <label for="input-content_name" class="required form-label">Ürün Adı</label>
                                <input type="text" name="input-content_name" id="input-content_name" class="form-control @error('input-content_name') is-invalid error-input @enderror" placeholder="Ürün Adı Giriniz" maxlength="50" value="{{ old('input-content_name', $digitalMenuContent->content_name) }}"/>
                                @if ($errors->has('input-content_name'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-content_name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-4">
                                <label for="input-content_description" class="required form-label">Ürün Açıklaması</label>
                                <input type="text" name="input-content_description" id="input-content_description" class="form-control @error('input-content_description') is-invalid error-input @enderror" placeholder="Ürün Açıklaması Giriniz" maxlength="50" value="{{ old('input-content_description', $digitalMenuContent->content_description) }}"/>
                                @if ($errors->has('input-content_description'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-content_description') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-4">
                                <label for="input-content_price" class="required form-label">Ürün Fiyatı</label>
                                <input type="number" step="0.01" min="0" name="input-content_price" id="input-content_price" class="form-control @error('input-content_price') is-invalid error-input @enderror" placeholder="Ürün Fiyatı Giriniz" maxlength="50" value="{{ old('input-content_price', $digitalMenuContent->content_price) }}"/>
                                @if ($errors->has('input-content_price'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-content_price') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-12">
                                <label for="input-digital_menu_category_id" class="required form-label">Menü Kategorisi Seçimi</label>
                                <select class="form-select @error('input-digital_menu_category_id') is-invalid error-input @enderror" name="input-digital_menu_category_id" id="input-digital_menu_category_id" data-control="select2" data-placeholder="Seçim Yapınız" data-hide-search="true">
                                    <option></option>
                                    @foreach($digitalMenuCategories as $digitalMenuCategory)
                                        <option value="{{ $digitalMenuCategory->id }}" @if (old('input-digital_menu_category_id', $digitalMenuContent->linked_digital_menu_category_id) == $digitalMenuCategory->id) selected="selected" @endif>{{ $digitalMenuCategory->category_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('input-digital_menu_category_id'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-digital_menu_category_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mt-6">
                            <div class="col-12">
                                @php
                                    $imagePath = "uploads/products/".$digitalMenuContent->linked_client_id."/".$digitalMenuContent->id."/".$digitalMenuContent->id.".jpg";
                                @endphp
                                <label for="input-product_main_image" class="form-label">Ürün Manşet Resmi</label>
                                @if(Storage::disk('public')->exists($imagePath))
                                    <a class="text-primary" data-fslightbox="lightbox-basic" href="{{ asset('storage/'.$imagePath) }}?v={{ time() }}">(Mevcut Görsel Önizleme)</a>
                                @endif

                                <input type="file" name="input-product_main_image" id="input-product_main_image" class="form-control @error('input-product_main_image') is-invalid error-input @enderror"/>

                                @if ($errors->has('input-product_main_image'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-product_main_image') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mt-6">
                            <div class="col-12">
                                <label for="input-is_active" class="required form-label">Durumu</label>
                                <select class="form-select @error('input-is_active') is-invalid error-input @enderror" name="input-is_active" id="input-is_active" data-control="select2" data-placeholder="Seçim Yapınız" data-hide-search="true">
                                    <option></option>
                                    <option value="1" {{ old('input-is_active', $digitalMenuContent->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('input-is_active', $digitalMenuContent->is_active) == '0' ? 'selected' : '' }}>Pasif</option>
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
                    <a href="{{ route('DigitalMenuContents.Index') }}" class="btn btn-light-danger btn-sm ms-2">Geri Dön</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('PageVendorJS')
    <script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
@endsection

@section('PageCustomJS')

@endsection

@section('PageModals')

@endsection
