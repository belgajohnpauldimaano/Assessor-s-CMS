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
            <h3 class="page-header">Employment Record</h3>
            
        </div>
        <div class="col-sm-12">
            <h3></h3>
            <div class="pull-right" style="margin-bottom:10px;">
                <button class="btn btn-default btn-xs js-add_record"> <i class="fa fa-plus"></i> Add</button>
            </div>
        </div>
        <div class="col-sm-12">
                    
                {{-- EMPLOYEMENT RECORD --}}
                {{-- <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>
                            <i class="glyphicon glyphicon-education"></i>
                            Employement Record
                            <div class="pull-right">
                                <button class="btn btn-success btn-xs js-add_training"> <i class="fa fa-plus"></i> Add</button>
                            </div>
                        </h4>
                    </div>

                    <div class="panel-body"> --}}
                        <div id="training-msg"></div>
                        <div id="training-info" class="">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Designation</th>
                                        <th>Company</th>
                                        <th>Parent Company</th>
                                        <th>Address</th>
                                        <th>Date of Service</th>
                                        <th>Telephone No.</th>
                                        <th>Fax No.</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="employement_record-data">
                                    @if($pqa_assessors_employment_record != null)

                                        @foreach($pqa_assessors_employment_record as $employmentrecord)
                                            <tr>
                                                <td>{{ $employmentrecord->designation }}</td>
                                                <td>{{ $employmentrecord->company }}</td>
                                                <td>{{ $employmentrecord->parent_company }}</td>
                                                <td>{{ $employmentrecord->address }}</td>
                                                <td>{{ $employmentrecord->date_of_service }}</td>
                                                <td>{{ $employmentrecord->tel_no }}</td>
                                                <td>{{ $employmentrecord->fax_no }}</td>
                                                <td>{{ $employmentrecord->email_address }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default btn-md dropdown-toggle" data-toggle="dropdown">
                                                            Options
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right">
                                                            <?php $id = encrypt($employmentrecord->id); ?>
                                                            <li>
                                                                <a href="#" class="js-update_employment_record" data-id="{{ $id }}">Update</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="js-delete_employment_record" data-id="{{ $id }}">Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            {{-- <tr>
                                                <td>
                                                    
                                                </td>
                                            </tr> --}}
                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="8">
                                                No Data Found
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        {{-- </div>
                        
                    </div>
                </div> --}}
                {{-- EMPLOYEMENT RECORD --}}

        </div>



        <div class="col-sm-12">
            <h3 class="page-header">Consultancy Work</h3>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <textarea name="consultancy" id="consultancy" cols="30" rows="7" class="form-control">{{ ($pqa_assessors_consultancy_work ? $pqa_assessors_consultancy_work->consultancy : '') }}</textarea>
            </div>
            <button class="btn btn-primary js-save_consultancy" style="margin-bottom:30px;">Save</button>
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
                url     : "{{ route('fetch_employment_record') }}",
                type    : 'POST',
                data    : {_token : "{{ csrf_token() }}"},
                success : function (data) {
                    $('#employement_record-data').empty().append(data);
                }
            });
        }

        // Show Add modal
        $('body').on('click', '.js-add_record', function() {
            form_employment_record_modal('');
        });
        // Trigger Edit Option
        $('body').on('click', '.js-update_employment_record', function () {
            var id = $(this).data('id');
            form_employment_record_modal(id);
        });
        // Trigger Delete Option
        $('body').on('click', '.js-delete_employment_record', function () {
            var id = $(this).data('id');
            bootbox.confirm({
                title : 'Confirmation',
                message : 'Are you sure you want to delete?',
                callback : function (result) {
                    if (result)
                    {
                        $.ajax({
                            url         : "{{ route('delete_employment_record') }}",
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
                    }
                }
            });
        });
        function form_employment_record_modal (id)
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
                 url     : "{{ route('form_employment_record_modal') }}",
                type    : 'POST',
                data    : data,
                success : function (data) {
                    $('#modal_holder').empty().append(data);
                    $('#assessors_modal').modal({ backdrop: true, keyboard: false });
                    
                    var d = new Date();
                    $('.dateservice').datepicker({
                        defaultViewDate: { year: d.getFullYear(), month: d.getMonth(), day: d.getDay() }
                    }); 
                }
            });
        }

        // Trigger click js-employment_record
        $('body').on('click', '.js-employment_record', function () {
            var formData = new FormData( $('#frm_employment_record')[0] );
            $('#modal-loading').modal('show');
            // Save Employment Record Function
            $.ajax({
                url         :"{{ route('save_employment_record') }}",
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
                        show_Alert_Bootbox(data['errMsgs']);
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

        // Consultancy
        $('body').on('click', '.js-save_consultancy', function () {
            $.ajax({
                url : "{{ route('save_consultancy') }}",
                type : 'POST',
                data : {_token : '{{ csrf_token() }}', consultancy : $('#consultancy').val()},
                dataType : 'JSON',
                success  : function (data) {
                    bootbox.alert({ message : data['errMsgs'], size : 'small' });
                }
            });
        });

        $(function () {
            //fetch_records();
        });
    </script>
@endsection