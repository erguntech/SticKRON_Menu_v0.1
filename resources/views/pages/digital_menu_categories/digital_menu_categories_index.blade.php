@extends('layouts.application.layout_application')
@section('PageTitle', 'Menü Kategorileri')

@section('PageVendorCSS')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('PageCustomCSS')
    <style>
        thead th { white-space: nowrap; }
    </style>
@endsection

@section('Breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 ">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('Dashboards.Index') }}" class="text-muted text-hover-primary">{{ Settings::get('app_alias') }}</a>
        </li>
    </ul>
@endsection

@section('PageContent')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-12">
            @if (session('result'))
                @include('components.alert', $data = ['alert_type' => session('result'), 'alert_title' => session('title'), 'alert_content' => session('content')])
            @endif
            <div class="card card-dashed" style="border-style: dotted">
                <div class="card-header ribbon ribbon-start ribbon-clip">
                    <div class="ribbon-label bg-primary-active fs-6" style="padding: 10px 15px;"><span class="d-flex text-white fw-bolder fs-6">Menü Kategorileri Tablosu</span></div>
                    <h3 class="card-title"></h3>
                    <div class="card-toolbar">
                        <a href="{{ route('DigitalMenuCategories.Sort.Index') }}" class="btn btn-light-primary btn-icon btn-sm">
                            <i class="fas fa-sort"></i>
                        </a>
                        <a href="{{ route('DigitalMenuCategories.Create') }}" class="btn btn-light-success btn-icon btn-sm ms-2">
                            <i class="fas fa-plus"></i>
                        </a>
                        <a onclick="dtReset()" class="btn btn-icon btn-light-warning btn-sm ms-2">
                            <i class="fas fa-redo-alt fs-5"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row p-0">

                        <div class="input-group mb-5">
                            <span class="input-group-text">Arama</span>
                            <input type="text" id="table-search" class="form-control" placeholder="..."/>
                        </div>

                        <table id="datatable" class="table table-hover table-rounded table-row-bordered table-row-gray-200 gy-1 gs-10" style="min-height: 100%; width: 100% !important;">
                            <thead>
                            <tr class="fw-bolder fs-7 text-uppercase gy-5">
                                <th style="width: 5%;">No</th>
                                <th>Kategori Adı</th>
                                <th>Kategori Açıklaması</th>
                                <th>Durumu</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-700 fw-bold"></tbody>
                        </table>
                        <div class="alert bg-light-success d-flex flex-column flex-sm-row p-2 mt-2" style="padding-left: 15px !important;">
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <span id="dt_info"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('PageVendorJS')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection

@section('PageCustomJS')
    <script>
        var table, dt;
        var editUrl = '{{ route("DigitalMenuCategories.Edit", ":id") }}';

        DataTable.type('num', 'detect', () => false);
        DataTable.type('num-fmt', 'detect', () => false);
        DataTable.type('html-num', 'detect', () => false);
        DataTable.type('html-num-fmt', 'detect', () => false);

        var initDatatable = function () {
            dt = $("#datatable").DataTable({
                searchDelay: 10000,
                processing: true,
                serverSide: false,
                order: [[0, 'asc']],
                autoWidth: false,
                responsive: false,
                pageLength: 10,
                searching: false,
                scrollX: false,
                lengthChange: false,
                fnCreatedRow: function( nRow, aData, iDataIndex ) {
                    $(nRow).children("td").css("white-space", "nowrap");
                },
                bLengthChange: true,
                stateSave: true,
                pagingType: "simple_numbers",
                info: false,
                ajax: {
                    url : "{{ route('DigitalMenuCategories.Index') }}",
                },
                language: {
                    url: '{{ asset('assets/plugins/custom/datatables/lang/tr_TR.json') }}'
                },
                columns: [
                    { data: 'id' },
                    { data: 'categoryName' },
                    { data: 'categoryDescription' },
                    { data: 'categoryStatus' },
                    { data: null },
                ],
                columnDefs: [
                    { type: 'turkish', targets: [0,1] },
                    { targets : 0,
                        render : function (data, type, row) {
                            return '<span class="badge badge-square badge-light-warning"><strong>'+ data +'</strong></span>';
                        }
                    },
                    { targets: -1,
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function (data, type, row) {
                            return `<a class="btn btn-icon btn-light-warning" href="`+ editUrl.replace(':id', row.id) +`" style="height: calc(2.05em);"><i class="fas fa-edit fs-5" style="margin-top: 1px;"></i></a>
                            <a class="btn btn-icon btn-light-danger" onclick="deleteData(this)" data-id="`+ row.id +`" style="height: calc(2.05em);"><i class="fas fa-trash-alt fs-5" style="margin-top: 2px;"></i></a>
                            `;
                        },
                    },
                    { className: "dt-settings", "targets": [ -1 ] },
                ],
                drawCallback : function() {
                    if ($('#datatable tr').length < 10) {
                        $('.dt-paging').hide();
                    }
                    processInfo(this.api().page.info());
                },
            });

            table = dt.$;

            dt.on('draw', function () {
                KTMenu.createInstances();
            });

            $('#table-search').keyup(function(){
                dt.search($(this).val()).draw();
            });
        };

        function processInfo(info) {
            $("#dt_info").html('Toplam ' + info.recordsTotal + ' Kayıttan ' + (info.start+1) + ' - ' + info.end + ' Arası Gösteriliyor.');
        }

        KTUtil.onDOMContentLoaded(function () {
            initDatatable();
        });

        function dtReset() {
            $("#datatable").DataTable().page.len(10).draw();
            $("#datatable").DataTable().state.clear();
            $("#datatable").DataTable().ajax.reload();
        }
    </script>

    <script type="text/javascript">
        function deleteData(btn) {
            Swal.fire({
                title: 'Seçtiğiniz Kayıt Sistemden Silinecek! Emin Misiniz?',
                text: 'Bu işlem geri alınamaz.',
                icon: 'error',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonText: 'Onayla!',
                cancelButtonText: 'Geri Dön',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-warning ml-1',
                    title: 'text-white'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: "categories/"+btn.getAttribute('data-id'),
                        type: 'DELETE',
                        data: {
                            "id": btn.getAttribute('data-id'),
                            "_token": $("meta[name='csrf-token']").attr("content"),
                        },
                        success: function (){
                            Swal.fire({
                                icon: 'success',
                                title: 'Kayıt Sistemden Silindi!',
                                text: 'Seçtiğiniz kayıt sistemden kaldırıldı.',
                                confirmButtonText: 'Tamam',
                                allowOutsideClick: false,
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                    title: 'text-white'
                                }
                            }).then(function (result) {
                                dtReset();
                            })
                        }, error: function (data) { console.log(data) }
                    });
                }
            });
        }
    </script>
@endsection

@section('PageModals')

@endsection
