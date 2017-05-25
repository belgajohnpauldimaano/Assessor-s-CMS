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

<form id="frm_rankings">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-header">Capability Assessment Ranking</h3>
            
        </div>
        <div class="col-sm-12">
        </div>
        <div class="col-sm-6">
                    
                {{-- FIRST --}}
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Please rank from 1 to 7 your ability to evaluate applications in the following areas: 1 = best (USE NO NUMBER MORE THAN ONCE)
                    </div>
                    <div class="panel-body">
                        <?php $options1 = [
                                            'Leadership', 
                                            'Strategy', 
                                            'Customer', 
                                            'Measurement, Analysis and Knowledge Management', 
                                            'Workforce', 
                                            'Operations', 
                                            'Results']; 
                        ?>
                        <table class="table text-center" cellpadding="10">

                            @foreach ($options1 as $key => $opt)
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-md js-btn_show_option1_modal btn-default" data-value="" id="opt1_{{ $key + 1 }}" data-id="opt1_{{ $key + 1 }}">{{ ( $data1 ? $data1[$key] : 'n/a' ) }}</button>
                                            <button type="button" class="btn btn-md js-option1_remove_rank btn-default" data-id="opt1_{{ $key + 1 }}">x</button>
                                        </div>
                                        <input type="hidden" value="{{ ( $data1 ? $data1[$key] : '' ) }}" name="input_opt1_{{ $key + 1 }}" id="input_opt1_{{ $key + 1 }}">
                                        
                                    </td>
                                    <td>{{ $opt }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>


                {{-- FIRST --}}

        </div>

        <div class="col-sm-6">
                    
                {{-- SECOND --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Please rank from 1 to 10 your ability to evaluate applications in the following areas: 1 = best (USE NO NUMBER MORE THAN ONCE)
                    </div>
                    <div class="panel-body">
                        <?php $options1 = [
                                            'Private - Manufacturing', 
                                            'Private – Service', 
                                            'Private – Education', 
                                            'Private – Healthcare', 
                                            'Private – Agriculture', 
                                            'Public – National Government Agencies',
                                            'Public – Local Government Units',
                                            'Public – Government-Owned and Controlled Corporations',
                                            'Public – State Universities/Colleges',
                                            'Public – State Hospitals']; 
                        ?>
                        <table class="table text-center" cellpadding="10">
                            @foreach ($options1 as $key => $opt)
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-md js-btn_show_option2_modal btn-default" data-value="" id="opt2_{{ $key + 1 }}" data-id="opt2_{{ $key + 1 }}">{{ ( $data2 ? $data2[$key] : 'n/a' ) }}</button>
                                            <button type="button" class="btn btn-md js-option2_remove_rank btn-default" data-id="opt2_{{ $key + 1 }}">x</button>
                                        </div>
                                        <input type="hidden" value="{{ ( $data2 ? $data2[$key] : '' ) }}" name="input_opt2_{{ $key + 1 }}" id="input_opt2_{{ $key + 1 }}">
                                        
                                    </td>
                                    <td>{{ $opt }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                {{-- SECOND --}}

        </div>
        

        <div class="col-sm-12">
            <button type="button" class="btn btn-primary pull-right js-save_ranks">Save</button>
        </div>

    </div>{{--  ROW --}}
</form>
    <div style="margin-bottom : 3% "></div>

<div class="modal fade modal-ranks" tabindex="-1" role="dialog" id="modal-ranks">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Select</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <input type="hidden" id="selected_id">
            <?php $option1_select = [1,2,3,4,5,6,7]; ?>
            <select name="select_opt1" id="select_opt1" class="form-control">
                    <option value="">n/a</option>
                @foreach($option1_select as $opt)
                    <option value="{{ $opt }}" id="select1_option{{ $opt }}" >{{ $opt }}</option>
                @endforeach
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary js-save_rank">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade modal-ranks2" tabindex="-1" role="dialog" id="modal-ranks2">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Select</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <input type="hidden" id="selected2_id">
            <?php $option2_select = [1,2,3,4,5,6,7,8,9,10]; ?>
            <select name="select_opt2" id="select_opt2" class="form-control">
                    <option value="">n/a</option>
                @foreach($option2_select as $opt)
                    <option value="{{ $opt }}" id="select1_option{{ $opt }}" >{{ $opt }}</option>
                @endforeach
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary js-save_rank2">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('scripts')
    <script>

        var selected_button_id;
        $('body').on('click', '.js-btn_show_option1_modal', function () {

            var id = $(this).data('id');
            var value = $('#input_' + id).val();

            selected_button_id = id;


            $('#selected_id').val(id);
            $('#select_opt1').val(value);
            $('#modal-ranks').modal({ keyboard : false, backdrop : true });

        });

     
        
        $('body').on('click', '.js-option1_remove_rank', function () {

            var id = $(this).data('id');
            var val = parseInt( $('#input_'+id).val() );
            
            if (!NaN)
            {
                $('#'+id).removeClass('disabled');
                $('#'+id).attr('disabled', false);
                $('#'+id).text('N/A');
                option1_select_array[val - 1] = val
                $('#input_'+id).val('');
                draw_select();

                console.log(val);
            }

        });
        $('body').on('click', '.js-save_rank', function () {
            get_selected();
            draw_select();
            $('#modal-ranks').modal('hide');
            $('#'+selected_button_id).addClass('disabled');
            $('#'+selected_button_id).attr('disabled', true);
        });
        

        //var option1_select_array = [1,2,3,4,5,6,7];
        var option1_select_array;
        @if($data1 != null)
            option1_select_array = [0,0,0,0,0,0,0];
        @else
            option1_select_array = [1,2,3,4,5,6,7];
        @endif
        var option1_select_selected_array = [];

        function get_selected ()
        {
            var val = parseInt( $('#select_opt1').val() );

            $('#input_' + $('#selected_id').val()).val(val);

            $('#' + $('#selected_id').val()).text(val);

            option1_select_array[val - 1] = 0;
        }

        function draw_select () 
        {
            $('#select_opt1').empty();

            var options = '';
            $.each(option1_select_array, function (index, value) {
                console.log( index + " " + value );
                var tmp = ( value == 0 ? 'disabled': '');
                options += '<option value="'+ parseInt(index + 1) +'" id="select1_option'+ parseInt(index + 1) +'" '+tmp+'>'+ parseInt(index + 1) +'</option>'
            });
            $('#select_opt1').append(options);
        }



        // SECOND

        var selected_button2_id;
        $('body').on('click', '.js-btn_show_option2_modal', function () {

            var id = $(this).data('id');
            var value = $('#input_' + id).val();

            selected_button2_id = id;


            $('#selected2_id').val(id);
            $('#select_opt2').val(value);
            $('#modal-ranks2').modal({ keyboard : false, backdrop : true });

        });

        $('body').on('click', '.js-save_rank2', function () {
            get_selected2();
            draw_select2();
            $('#modal-ranks2').modal('hide');
            $('#'+selected_button2_id).addClass('disabled');
            $('#'+selected_button2_id).attr('disabled', true);
        });

        var option2_select_array;
        @if($data1 != null)
            option2_select_array = [0,0,0,0,0,0,0,0,0,0];
        @else
            option2_select_array = [1,2,3,4,5,6,7,8,9,10];
        @endif
        function get_selected2 ()
        {
            var val = parseInt( $('#select_opt2').val() );

            $('#input_' + $('#selected2_id').val()).val(val);

            $('#' + $('#selected2_id').val()).text(val);

            option2_select_array[val - 1] = 0;
        }

        function draw_select2 () 
        {
            $('#select_opt2').empty();

            var options = '';
            $.each(option2_select_array, function (index, value) {
                console.log( index + " " + value );
                var tmp = ( value == 0 ? 'disabled': '');
                options += '<option value="'+ parseInt(index + 1) +'" id="select2_option'+ parseInt(index + 1) +'" '+tmp+'>'+ parseInt(index + 1) +'</option>'
            });
            $('#select_opt2').append(options);
        }


        // removing ranks 
        $('body').on('click', '.js-option2_remove_rank', function () {

            var id = $(this).data('id');
            var val = parseInt( $('#input_'+id).val() );
            if (!NaN)
            {
                $('#'+id).removeClass('disabled');
                $('#'+id).attr('disabled', false);
                $('#'+id).text('N/A');
                option2_select_array[val - 1] = val
                $('#input_'+id).val('');
                draw_select2();

                console.log(val);
            }

        });


        // Saving Ranks
        $('body').on('click', '.js-save_ranks', function () {
            var formData = new FormData($('#frm_rankings')[0]);
            $.ajax({
                url         : "{{ route('save_capability_assessment') }}",
                type        : 'POST',
                data        : formData,
                dataType    : 'JSON',
                contentType : false,
                processData : false,
                success     : function (data) {
                    if(data.errCode == '0')
                    {
                        show_Alert_Bootbox(data.msg);
                    }
                    else
                    {
                        show_Alert_Bootbox('Error : Please complete the ranking before saving.');
                    }
                }
            });
        });
        $(function () {
            draw_select();
            draw_select2();
        });
    </script>
@endsection