
<div class="modal fade" tabindex="-1" role="dialog" id="assessors_basic_info">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Personal Information</h4>
      </div>
      <div class="modal-body">
        <form action="" id="frm_personal_info">
            {{ csrf_field() }}
            <input type="hidden" id="id" name="id" value="{{ encrypt($pqa_assessors_info->assessors_ID) }}">
            <div class="form-group">
                <label for="">Name <span class="text-danger">*</span></label> 
                <input type="text" class="form-control" placeholder="Name" data-id="assessors_name" name="assessors_name" id="assessors_name" value="{{ $pqa_assessors_info->assessors_name }}">
                <div class="help-block text-center" id="assessors_name-error">

                </div>
            </div>
            
            <div class="form-group">
                <label for="">Date of Birth <span class="text-danger">*</span></label>
                <input type="text" placeholder="mm/dd/yyyy" class="form-control assessors_birth_date" data-id="assessors_birth_date" name="assessors_birth_date" id="assessors_birth_date" value="{{ ($pqa_assessors_info->details ?  date('m/d/Y', strtotime($pqa_assessors_info->details->date_of_birth)) : '') }}">
                <div class="help-block text-center" id="assessors_birth_date-error">

                </div>
            </div>
            
            <div class="form-group">
                <label for="">Place of Birth <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Place of Birth" data-id="assessors_birth_place" name="assessors_birth_place" id="assessors_birth_place" value="{{ ($pqa_assessors_info->details ? $pqa_assessors_info->details->place_of_birth : '') }}">
                <div class="help-block text-center" id="assessors_birth_place-error">

                </div>
            </div>
            
            <div class="form-group">
                <label for="">Home Address <span class="text-danger">*</span></label>
                <textarea class="form-control" placeholder="Address" data-id="assessors_home_address" name="assessors_home_address" id="assessors_home_address" cols="30" rows="5">{{ ($pqa_assessors_info->details ? $pqa_assessors_info->details->home_address : '' ) }}</textarea>
                <div class="help-block text-center" id="assessors_home_address-error">

                </div>
            </div>

            <div class="form-group">
                <label for="">Telephone No. <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Telephone No." data-id="assessors_tel_no" name="assessors_tel_no" id="assessors_tel_no" value="{{ ($pqa_assessors_info->details ? $pqa_assessors_info->details->tel_no : '') }}">
                <div class="help-block text-center" id="assessors_tel_no-error">

                </div>
            </div>
            
            <div class="form-group">
                <label for="">Mobile No. <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Mobile No." data-id="assessors_mobile_no" name="assessors_mobile_no" id="assessors_mobile_no" value="{{ ($pqa_assessors_info->details ? $pqa_assessors_info->details->mobile_no : '') }}">
                <div class="help-block text-center" id="assessors_mobile_no-error">

                </div>
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <div class="pull-left">
            <p class="text-danger">
                All fields with an asterisk (*) are required.
            </p>
        </div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary js-save_personal_info">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
