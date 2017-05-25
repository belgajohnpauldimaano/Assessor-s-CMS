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
            <h3 class="page-header">Disclosure of Conflict of Interest</h3>
        </div>
        <div class="col-sm-12">
            <h3></h3>
            <div class="pull-right" style="margin-bottom:10px;">
                <button class="btn btn-default btn-md js-add_data"> <i class="fa fa-plus"></i> Add</button>
                
            </div>
        </div>
        <div class="col-sm-12">
                    
                {{-- DATA RECORD --}}

                <div id="msg"></div>
                <div id="info" class="">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Organizations</th>
                                <th>Industries</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="record-data">
                            @if($pqa_assessors_interest_conflict_disclosure->count() > 0)
                                @foreach($pqa_assessors_interest_conflict_disclosure as $data)
                                    <tr>
                                        <td>{{ $data->organizations }}</td>
                                        <td>{{ $data->industries }}</td>
                                        <td>
                                            <?php
                                                $id = encrypt($data->id);
                                            ?>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-md dropdown-toggle" data-toggle="dropdown">
                                                    Options
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <?php $id = encrypt($data->id); ?>
                                                    <li>
                                                        <a href="#" class="js-update_data" data-id="{{ $id }}">Update</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="js-delete_data" data-id="{{ $id }}">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">No data found.</td>
                                </tr>
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
        
        function fetch_records () 
        {
            $.ajax({
                url     : "{{ route('disclosure_conflict_interest_records') }}",
                type    : 'POST',
                data    : {_token : "{{ csrf_token() }}"},
                success : function (data) {
                    $('#record-data').empty().append(data);
                }
            });
        }

        // Show Add modal
        $('body').on('click', '.js-add_data', function() {
            disclosure_conflict_interest_form_modal('');
        });
        // Trigger Edit Option
        $('body').on('click', '.js-update_data', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            disclosure_conflict_interest_form_modal(id);
        });
        // Trigger Delete Option
        $('body').on('click', '.js-delete_data', function () {
            var id = $(this).data('id');
            bootbox.confirm({
                title : 'Confirmation',
                message : 'Are you sure you want to delete?',
                callback : function (result) {
                    if (result)
                    {
                        $('#modal-loading').modal('show');
                        $.ajax({
                            url         : "{{ route('disclosure_conflict_interest_delete') }}",
                            type        : 'POST',
                            data        : {_token : "{{ csrf_token() }}", id : id},
                            dataType    : 'JSON',
                            success     : function (data) {
                                if(data['errCode'] == 0)
                                {
                                    bootbox.alert({message : data['errMsgs'], size: 'small'});  
                                    fetch_records();
                                }
                                else
                                {
                                    bootbox.alert({message : data['errMsgs'], size: 'small'}); 
                                }
                                
                                
                            }
                        });
                        $('#modal-loading').modal('hide');
                    }
                }
            });
        });
        function disclosure_conflict_interest_form_modal (id)
        {
            var data;
            if (id == '')
            {
                data = { _token : "{{ csrf_token() }}" };
            }
            else
            {
                data = { _token : "{{ csrf_token() }}", id : id };
            }

            $.ajax({
                 url     : "{{ route('disclosure_conflict_interest_form_modal') }}",
                type    : 'POST',
                data    : data,
                success : function (data) {
                    $('#modal_holder').empty().append(data);
                    $('#assessors_modal').modal({ backdrop: true, keyboard: false });
                }
            });
        }

        // Trigger click js-employment_record
        $('body').on('click', '.js-save_data', function () {
            var formData = new FormData( $('#frm_data')[0] );
            $('#modal-loading').modal('show');
            // Save 
            $.ajax({
                url         :"{{ route('disclosure_conflict_interest_save') }}",
                type        : 'POST',
                data        : formData,
                dataType    : 'JSON',
                contentType : false,
                processData : false,
                success     : function (data) {
                    $('.help-block').empty();
                    $('.form-control').parents('.form-group').removeClass('has-error');
                    if(data['errCode'] == 1)
                    {
                        for(var err in data['errMsgs'])
                        {
                            $('#'+err).parents('.form-group').addClass('has-error');
                            $('#'+err+'-error').html('<code>'+ data['errMsgs'][err] +'</code>');
                        }
                    }
                    else if (data['errCode'] == 2)
                    {
                        $('#general-error').html('<code>'+ data['errMsgs']+'</code>');
                    }
                    else
                    {
                        fetch_records();
                        $('#assessors_modal').modal('hide');
                    }
                    $('#modal-loading').modal('hide');
                }
            });
        });

        // Removing the error class and html content for error on focus
        $('body').on('focus', '.form-control', function (){
            var id = $(this).data('id');
            if($('#' + id).parents('.form-group').hasClass('has-error'))
            {
                $('#' + id).parents('.form-group').removeClass('has-error');
                $('#' + id + '-error').empty()
            }
        });
        $(function () {
            //fetch_records();
        });
    </script>
@endsection