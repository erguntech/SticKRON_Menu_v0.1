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
                    <form action="{{ route('DigitalMenuCampaigns.Update', $digitalMenuCampaign->id) }}" id="editForm" enctype="multipart/form-data" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <label for="input-campaign_name" class="required form-label">Kampamya Adı</label>
                                <input type="text" name="input-campaign_name" id="input-campaign_name" class="form-control @error('input-campaign_name') is-invalid error-input @enderror" placeholder="Kampamya Adı Giriniz" maxlength="50" value="{{ old('input-campaign_name', $digitalMenuCampaign->campaign_name) }}"/>
                                @if ($errors->has('input-campaign_name'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-campaign_name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <label for="input-campaign_description" class="required form-label">Kampamya Açıklaması</label>
                                <input type="text" name="input-campaign_description" id="input-campaign_description" class="form-control @error('input-campaign_description') is-invalid error-input @enderror" placeholder="Kampamya Açıklaması Giriniz" maxlength="50" value="{{ old('input-campaign_description', $digitalMenuCampaign->campaign_description) }}"/>
                                @if ($errors->has('input-campaign_description'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-campaign_description') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-6">
                                <label for="input-campaign_standard_price" class="required form-label">Kampamya Normal Fiyatı</label>
                                <input type="text" name="input-campaign_standard_price" id="input-campaign_standard_price" class="form-control @error('input-campaign_standard_price') is-invalid error-input @enderror" placeholder="Kampamya Normal Fiyatı Giriniz" maxlength="50" value="{{ old('input-campaign_standard_price', $digitalMenuCampaign->campaign_standard_price) }}"/>                                @if ($errors->has('input-campaign_standard_price'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-campaign_standard_price') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <label for="input-campaign_discounted_price" class="required form-label">Kampamya İndirimli Fiyatı</label>
                                <input type="text" name="input-campaign_discounted_price" id="input-campaign_discounted_price" class="form-control @error('input-campaign_discounted_price') is-invalid error-input @enderror" placeholder="Kampamya İndirimli Fiyatı Giriniz" maxlength="50" value="{{ old('input-campaign_discounted_price', $digitalMenuCampaign->campaign_discounted_price) }}"/>
                                @if ($errors->has('input-campaign_discounted_price'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-campaign_discounted_price') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mt-6">
                            <div class="col-12">
                                @php
                                    $imagePath = "uploads/campaigns/".$digitalMenuCampaign->linked_client_id."/".$digitalMenuCampaign->id."/".$digitalMenuCampaign->id.".jpg";
                                @endphp
                                <label for="input-campaign_main_image" class="form-label">Kampanya Manşet Resmi</label>
                                @if(Storage::disk('public')->exists($imagePath))
                                    <a class="text-primary" data-fslightbox="lightbox-basic" href="{{ asset('storage/'.$imagePath) }}">(Mevcut Görsel Önizleme)</a>
                                @endif

                                <input type="file" name="input-campaign_main_image" id="input-campaign_main_image" class="form-control @error('input-campaign_main_image') is-invalid error-input @enderror"/>

                                @if ($errors->has('input-campaign_main_image'))
                                    <div class="invalid-feedback">
                                        @ {{ $errors->first('input-campaign_main_image') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mt-6">
                            <div class="col-12">
                                <label for="input-is_active" class="required form-label">Durumu</label>
                                <select class="form-select @error('input-is_active') is-invalid error-input @enderror" name="input-is_active" id="input-is_active" data-control="select2" data-placeholder="Seçim Yapınız" data-hide-search="true">
                                    <option></option>
                                    <option value="1" {{ old('input-is_active', $digitalMenuCampaign->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('input-is_active', $digitalMenuCampaign->is_active) == '0' ? 'selected' : '' }}>Pasif</option>
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
                    <a href="{{ route('DigitalMenuCampaigns.Index') }}" class="btn btn-light-danger btn-sm ms-2">Geri Dön</a>
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
