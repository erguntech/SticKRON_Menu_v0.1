@extends('layouts.application.layout_application')
@section('PageTitle', 'Kampanya Sıralaması')

@section('PageVendorCSS')

@endsection

@section('PageCustomCSS')
    <style>
        .handle {
            touch-action: none;
            user-select: none;
            -webkit-user-drag: none;
        }
        .sortable-ghost {
            opacity: 0.4;
            background: #c8ebfb;
        }
        .sortable-drag {
            opacity: 0.8;
        }
    </style>
@endsection

@section('Breadcrumb')

@endsection

@section('PageContent')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-12">

            <div class="alert alert-warning d-flex align-items-center p-5">
                <i class="ki-duotone ki-shield-tick fs-2hx text-warning me-4"><span class="path1"></span><span class="path2"></span></i>
                <div class="d-flex flex-column">
                    <h4 class="mb-1">@ Notlar</h4>
                    <span>- Aşağıdaki listedeki kayıtları sürükleyerek mevcut sıralamasını değiştirebilirsiniz.</span>
                </div>
            </div>

            @if (session('result'))
                <div class="mb-4">
                    @include('components.alert', $data = ['alert_type' => session('result'), 'alert_title' => session('title'), 'alert_content' => session('content')])
                </div>
            @endif
            @if (count($digitalMenuCampaigns) < 1)
                <div class="alert alert-info d-flex align-items-center p-5 mt-4">
                    <i class="ki-duotone ki-shield-tick fs-2hx text-info me-4"><span class="path1"></span><span class="path2"></span></i>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1">@ Dikkat</h4>
                        <span>- Sisteme eklenmiş herhangi bir kayıt bulunamadı. Lütfen önce <a href="{{ route('DigitalMenuCampaigns.Create') }}" class="text-success">"Kampanya Ekle"</a> kısmından sisteme yeni bir kayıt ekleyiniz.</span>
                    </div>
                </div>
            @else
                <div class="card shadow-sm">
                    <div class="card-header ribbon ribbon-start ribbon-clip">
                        <div class="ribbon-label bg-warning fs-6" style="padding: 10px 15px;"><span class="d-flex text-white fw-bolder fs-6">Kampanya Sıralaması Bilgileri</span></div>
                        <h3 class="card-title"></h3>
                        <div class="card-toolbar"></div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('DigitalMenuCampaigns.Sort.Update') }}" id="editForm" enctype="multipart/form-data" method="POST" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="row" id="sortList">
                                @foreach($digitalMenuCampaigns as $digitalMenuCampaign)
                                    <div class="sort-item alert alert-{{ ($digitalMenuCampaign->is_active) ? 'primary' : 'warning' }} d-flex align-items-center p-3" data-id="{{ $digitalMenuCampaign->id }}">
                                        <span class="position-badge badge badge-{{ ($digitalMenuCampaign->is_active) ? 'primary' : 'warning' }} me-2">1</span>
                                        {{ $digitalMenuCampaign->campaign_name }} | {{ $digitalMenuCampaign->campaign_description }}
                                        <i class="handle ki-solid ki-abstract-14 fs-3 text-warning" style="position: absolute; right: 10px;"></i>
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="order" id="orderInput">
                        </form>
                        <div class="separator border-2 my-10"></div>
                        <button type="submit" class="btn btn-warning btn-sm" form="editForm">
                            <span class="indicator-label">Düzenle</span>
                            <span class="indicator-progress">Bekleyiniz... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('PageVendorJS')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
@endsection

@section('PageCustomJS')
    @if (count($digitalMenuCampaigns) > 0)
        <script>
            $( document ).ready(function() {
                document.querySelectorAll('.sort-item').forEach((item, index) => {
                    newPosition = index + 1;
                    item.querySelector('.position-badge').textContent = newPosition;
                });
            });

            var handleList = document.getElementById('sortList');
            var sortable = Sortable.create(handleList, {
                handle: '.handle', // Sadece bu sınıfa sahip öğe ile sürüklenebilir
                animation: 150,
                ghostClass: 'sortable-ghost',
                dragClass: 'sortable-drag',
                onEnd: function(evt) {
                    updateOrder();
                }
            });

            function updateOrder() {
                let order = [];
                document.querySelectorAll('.sort-item').forEach((item, index) => {
                    newPosition = index + 1;
                    item.querySelector('.position-badge').textContent = newPosition;
                    order.push({
                        id: item.dataset.id,
                        order: newPosition
                    });
                });

                document.getElementById('orderInput').value = JSON.stringify(order);
            }
        </script>
    @endif
@endsection

@section('PageModals')

@endsection
