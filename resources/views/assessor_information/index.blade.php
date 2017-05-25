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
            <h3 class="page-header">Assessor's Information</h3>
            
        </div>
        
        <div class="col-sm-12">

                {{-- PANEL ASSESSOR PERSONAL INFORMATION --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>
                            <i class="fa fa-user"></i>
                            Personal Information
                            <div class="pull-right" style="margin-bottom:10px;">
                                <button class="btn btn-default btn-xs js_edit_personal_info"> <i class="fa fa-pencil"></i> Edit</button>
                            </div>
                        </h4>
                    </div>
                    
                    <div class="panel-body basic-info">
                        <table class="table">
                            {{-- Name --}}
                            <tr>
                                <td>
                                    <div class="form-group col-md-8">
                                        <p>
                                            Name
                                            <strong>
                                                @if($pqa_assessors_info)
                                                    {{ $pqa_assessors_info->assessors_name }}
                                                @endif
                                            </strong>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            {{-- Date and Place of Birth --}}
                            <tr>
                                <td>
                                    <tr>
                                        <td>
                                            <div class="form-group col-md-8">
                                                <p>
                                                    Date of birth
                                                    @if($pqa_assessors_info->details)
                                                            <strong>{{ $pqa_assessors_info->details->date_of_birth }}</strong>
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group col-md-8">
                                                <p>
                                                    Place of birth
                                                    @if($pqa_assessors_info->details)
                                                        <strong>{{ $pqa_assessors_info->details->place_of_birth }}</strong>
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group col-md-8">
                                        <p>
                                            Home Address
                                            @if($pqa_assessors_info->details)
                                                <strong>{{ $pqa_assessors_info->details->home_address }}</strong>
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr> 
                            {{-- Telephone and Mobile No --}}
                             <tr>
                                <td>
                                    <tr>
                                        <td>
                                            <div class="form-group col-md-8">
                                                <p>
                                                    Telephone No.
                                                    @if($pqa_assessors_info->details)
                                                        <strong>{{ $pqa_assessors_info->details->tel_no }}</strong>
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group col-md-8">
                                                <p>
                                                    Mobile No.
                                                    @if($pqa_assessors_info->details)
                                                        <strong>{{ $pqa_assessors_info->details->mobile_no }}</strong>
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                </td>
                            </tr> 
                            {{-- Email Address --}}
                             <tr>
                                <td>
                                    <div class="form-group col-md-8">
                                        <p>
                                            Email Address
                                                @if($pqa_assessors_info->details)
                                                    <strong>{{ $pqa_assessors_info->assessors_email }}</strong>
                                                @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>  
                {{-- PANEL ASSESSOR PERSONAL INFORMATION --}}
                <div id="education-msg"></div>
                {{-- PANEL ASSESSORS EDUCATIONAL BACKGROUND --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>
                            <i class="glyphicon glyphicon-education"></i>
                            Educational Background
                            <div class="pull-right">
                                <button class="btn btn-default btn-xs js-add_education"> <i class="fa fa-plus"></i> Add</button>
                            </div>
                        </h4>
                    </div>

                    <div class="panel-body education-info">
                         <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name of University</th>
                                    <th>Field of Study</th>
                                    <th>Degree</th>
                                    <th>Year Obtained</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($pqa_assessors_educational_background != null)
                                @foreach($pqa_assessors_educational_background as $education)
                                    <tr>
                                        <td>{{ $education->university_name }}</td>
                                        <td>{{ $education->field_of_study }}</td>
                                        <td>{{ $education->degree }}</td>
                                        <td>{{ $education->year_obtained }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-md dropdown-toggle" data-toggle="dropdown">
                                                    Options
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="#" class="js-update_education" data-id="{{ encrypt($education->id) }}">Update</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="js-delete_education" data-id="{{ encrypt($education->id) }}">Delete</a>
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
                </div>
                {{-- PANEL ASSESSORS EDUCATIONAL BACKGROUND --}}

                
                {{-- TRAININGS ATTENDED --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>
                            <i class="glyphicon glyphicon-education"></i>
                            Trainings Attended
                            <div class="pull-right">
                                <button class="btn btn-default btn-xs js-add_training"> <i class="fa fa-plus"></i> Add</button>
                            </div>
                        </h4>
                    </div>

                    <div class="panel-body">
                        <div id="training-msg"></div>
                        <div id="training-info">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Provider</th>
                                        <th>Duration</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($pqa_assessors_trainings != null)
                                    @foreach($pqa_assessors_trainings as $training)
                                        <tr>
                                            <td>{{ $training->course }}</td>
                                            <td>{{ $training->provider }}</td>
                                            <td>
                                                {{ Date('Y-m-d', strtotime($training->date_from)) }} - {{ Date('Y-m-d', strtotime($training->date_to)) }}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-md dropdown-toggle" data-toggle="dropdown">
                                                        Options
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="#" class="js-update_training" data-id="{{encrypt($training->id)}}">Update</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="js-delete_training" data-id="{{encrypt($training->id)}}">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">No Data Found.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                {{-- TRAININGS ATTENDED --}}

        </div>
    </div>{{--  ROW --}}

    <div id="personal_info_modal_holder">
    </div>
@endsection

@section('scripts')
    <script>
    
        $('body').on('click', '.js_edit_personal_info', function () {
            $.ajax({
                url : "{{ route('fetch_personal_modal') }}",
                type : 'POST',
                data : {_token : "{{ csrf_token() }}"},
                success : function (data) {
                    $('#personal_info_modal_holder').empty().append(data);
                    $('#assessors_basic_info').modal({ backdrop: true, keyboard: false });
                    
                    var d = new Date();
                    $('.assessors_birth_date').datepicker({
                        defaultViewDate: { year: d.getFullYear(), month: d.getMonth(), day: d.getDay() }
                    }); 
                }
            });
        });
        $('body').on('click', '.js-save_personal_info', function (){
            
            var formData = new FormData( $('#frm_personal_info')[0] );
            $('#modal-loading').modal('show');
            $.ajax({

                url         : "{{ route('save_personal_info') }}",
                type        : 'POST',
                data        : formData,
                dataType    : 'JSON',
                processData : false,
                contentType : false,
                success     : function (data) {
                    
                    $('#modal-loading').modal('hide');
                    $('.help-block').empty();
                    $('.help-block').parents('.form-group').removeClass('has-error');
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
                        show_Alert_Bootbox(data['errMsgs']); 
                    }
                    else
                    {
                        $('#assessors_basic_info').modal('hide');
                        fetch_personal_info();
                    }
                }

            });
            /*bootbox.confirm({
                title: "Confirm",
                message: "Are you sure you want to update the information?",
                callback: function (result) {
                    $('.form-group').removeClass('has-error');
                       
                    if (result)
                    {
                        
                        
                    }
                    
                        if($('#assessors_basic_info').hasClass('in')) {
                            $('body').addClass('modal-open');
                        } 
                }
            });*/
            
        });


        function fetch_personal_info()
        {
            $.ajax({
                url : "{{ route('fetch_personal_info_ajax') }}",
                type : 'POST',
                data : { _token : "{{ csrf_token() }}"},
                success : function (data) {
                    $('.basic-info').empty().append(data);
                }
            });
        }

        // Education Modal
        $('body').on('click', '.js-add_education', function (){
            $.ajax({
                url : "{{ route('form_education_modal') }}",
                type : 'POST',
                data : {_token : "{{ csrf_token() }}"},
                success : function (data) {

                    $('#personal_info_modal_holder').empty().append(data);
                    $('#assessors_education_info').modal({ backdrop: true, keyboard: false });
                    

                    $('.date-picker').datepicker({
                        format: " yyyy",
                        viewMode: "years", 
                        minViewMode: "years"
                    });
                }
            });
        });

        // Education Delete Confirmation
        $('body').on('click', '.js-delete_education', function (e){
            e.preventDefault();
            var id = $(this).data('id');
            bootbox.confirm({
                title : "Confirm",
                message : "Are you sure you want to delete?",
                callback : function (result) {
                    if(result)
                    {
                        $.ajax({
                            url : "{{ route('delete_education') }}",
                            type : 'POST',
                            data : {_token : "{{ csrf_token() }}", id : id},
                            success : function (data) {
                                bootbox.alert({message : 'Successfully deleted.', size: 'small'});    
                                $('#education-msg').html('<h4>'+ data['errMsgs'] +'</h4>');
                                fetch_education_info();                            
                            }
                        });
                    }
                }
            });
        });
        
        // Edit Education
        $('body').on('click', '.js-update_education', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url : "{{ route('form_education_modal') }}",
                type : 'POST',
                data : {_token : "{{ csrf_token() }}", id : id},
                success : function (data) {
                    $('#personal_info_modal_holder').empty().append(data);
                    $('#assessors_education_info').modal({ backdrop: true, keyboard: false });
                    $('.date-picker').datepicker({
                        format: " yyyy",
                        viewMode: "years", 
                        minViewMode: "years"
                    });
                }
            });
        });

        // Save education info
        $('body').on('click', '.js-save_education_info', function () {
            var formData = new FormData($('#frm_education_info')[0]);
            $('#modal-loading').modal('show');
            $.ajax({
                url         : "{{ route('save_education') }}",
                type        : 'POST',
                data        : formData,
                dataType    : 'JSON',
                processData : false,
                contentType : false,
                success     : function (data) {
                    $('#modal-loading').modal('hide');
                    $('.help-block').parents('.form-group').removeClass('has-error');
                    $('.help-block').empty();
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
                        $('#assessors_education_info').modal('hide');
                        $('#education-msg').html('<h4>'+ data['errMsgs'] +'</h4>');
                        fetch_education_info();
                        show_Alert_Bootbox(data['errMsgs']); 
                    }
                }

            });
        });
        
        function fetch_education_info () 
        {
            $.ajax({
                url : "{{ route('fetch_education_info') }}",
                type : 'POST',
                data : { _token : "{{ csrf_token() }}"},
                success : function (data) {
                    $('.education-info').empty().append(data);
                }
            });
        }

        // Trainings 

        // Fetch Trainings
        
        function fetch_trainings() 
        {
            $.ajax({
                url : "{{ route('fetch_trainings') }}",
                type : 'POST',
                data : { _token : "{{ csrf_token() }}"},
                success : function (data) {
                    $('#training-info').empty().append(data);
                }
            });
        }

        // Add Training Form Modal

        function training_modal (id) 
        {
            var data;
            if(id == '')
            {
                data = {_token : "{{ csrf_token() }}" }
            }
            else
            {
                data = {_token : "{{ csrf_token() }}", id : id }
            }

            $.ajax({
                url : "{{ route('form_training_modal') }}",
                type : 'POST',
                data : data,
                success : function (data) {
                    var d = new Date();
                    $('#personal_info_modal_holder').empty().append(data);
                    $('#assessors_training_info').modal({ backdrop: true, keyboard: false });
                    $('.date_duration').datepicker({
                        defaultViewDate: { year: d.getFullYear(), month: d.getMonth(), day: d.getDay() }
                    }); 
                    
                }
            });
        }
        // Open Add Modal
        $('body').on('click', '.js-add_training', function () {
            training_modal('');
        }); 

        // Open Edit Modal
        $('body').on('click', '.js-update_training', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            training_modal(id);
        });
        
        // Open Delete Confirm Modal
        $('body').on('click', '.js-delete_training', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            
            bootbox.confirm({
                title : 'Confirm',
                message : 'Are you sure you want to delete?',
                callback : function (result) {
                    if(result)
                    {
                        $.ajax({
                            url : "{{ route('delete_training') }}",
                            type : 'POST',
                            data : {_token : "{{ csrf_token() }}", id : id},
                            success : function (data) {
                                show_Alert_Bootbox('Successfully deleted.'); 
                                $('#education-msg').html('<h4>'+ data['errMsgs'] +'</h4>');
                                fetch_trainings();

                            }
                        });
                    }
                } 
            });
        });
        
        // Submit Training Form
        $('body').on('click', '.js-training_info', function () {
            var formData = new FormData( $('#frm_training_info')[0] );
            $('#modal-loading').modal('show');
            $.ajax({
                url         : "{{ route('save_training') }}",
                type        : 'POST',
                data        : formData,
                dataType    : 'JSON',
                processData : false,
                contentType : false,
                success     : function (data) {
                    $('.help-block').empty();
                    $('.help-block').parents('.form-group').removeClass('has-error');
                        $('#modal-loading').modal('hide');
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
                        $('#assessors_training_info').modal('hide');
                        $('#training-msg').html('<h4>'+ data['errMsgs'] +'</h4>');
                        fetch_trainings();
                        show_Alert_Bootbox(data['errMsgs']); 
                    }
                }

            });
        });

        $(function (){
            //fetch_personal_info();
            //fetch_education_info();
            //fetch_trainings();
        })  
    </script>
@endsection