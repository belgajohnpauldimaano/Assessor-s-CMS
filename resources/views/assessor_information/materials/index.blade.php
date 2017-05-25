@extends('layouts.main')

@section('styles')
    <style>
        .table{
            border-bottom : 0px;
        }
        .basic-info>.table>tbody>tr>td, .basic-info>.table>tbody>tr>th, .basic-info>.table>tfoot>tr>td, .basic-info.table>tfoot>tr>th, .basic-info>.table>thead>tr>td, .basic-info>.table>thead>tr>th {
            padding: 0;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: none;
        }
        strong {
            margin-left : 20px;
        }
    </style>
@endsection

@section('content')
    {{-- ROW --}}
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-header">Assessor's Materials</h3>
            
        </div>
        <div class="col-sm-12">
                    
                {{-- DATA RECORD --}}

                <div id="msg"></div>
                <div id="info" class="">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Material Name</th>
                                <th>Material Url</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="record-data">
                            @if($pqa_assessors_materials != null)
                                @foreach ($pqa_assessors_materials as $material)
                                    <tr>
                                        <td><a href="{{ route('materials_download') }}/{{ $material->material_ID }}">{{ $material->material_file }}</a></td>
                                        <td>
                                            <a href="{{ $material->material_url_link }}" target="blank">
                                                {{ $material->material_url_link }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-md dropdown-toggle" data-toggle="dropdown">
                                                    Options
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="#" class="js-download_material" data-file="{{ $material->material_ID }}">Download</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ $material->material_url_link }}" target="blank" class="js-visit_link" data-link="{{ $material->material_url_link }}">Visit Link</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                        
                {{-- DATA RECORD --}}

        </div>


    </div>{{--  ROW --}}

    <div id="modal_holder">
    </div>
@endsection

@section('scripts')
    <script>
        $('body').on('click', '.js-download_material', function () {
            var file = $(this).data('file');
           window.location.href = "{{ route('materials_download') }}/"+file;
        });
        $(function () {
            /*$.ajax({
                url : "{{ route('materials_download', " + file + ") }}",
                success : function (data){
                    console.log(data)
                }
            });*/
        });
    </script>
@endsection