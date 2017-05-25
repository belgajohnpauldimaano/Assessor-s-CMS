
<div class="modal fade" tabindex="-1" role="dialog" id="assessors_education_info">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ ($pqa_assessors_educational_background ? 'Update Educational Background' : 'Add Educational Background') }}</h4>
      </div>
      <div class="modal-body">
        <form action="" id="frm_education_info">
            {{ csrf_field() }}
            <input type="hidden" name="type" data-id="provider" value="{{ ($pqa_assessors_educational_background ? '1' : '0') }}">
            <input type="hidden" id="id" name="id" value="{{ ( $pqa_assessors_educational_background ? encrypt($pqa_assessors_educational_background->id) : encrypt(-1)) }}">
            
            <div class="help-block text-center"  id="type-error">

            </div>
            <div class="help-block text-center" id="id-error">

            </div>
            <div class="help-block text-center" id="general-error">

            </div>
            <div class="form-group">
                <label for="">Name of University <span class="text-danger">*</span></label> 
                <input type="text" class="form-control" placeholder="University Name" data-id="university_name" name="university_name" id="university_name" value="{{ ($pqa_assessors_educational_background ? $pqa_assessors_educational_background->university_name : '') }}">
                <div class="help-block text-center" id="university_name-error">

                </div>
            </div>
            
            <div class="form-group">
                <label for="">Field of Study</label> 
                <input type="text" class="form-control" placeholder="Field of Study" data-id="field_of_study" name="field_of_study" id="field_of_study" value="{{ ($pqa_assessors_educational_background ? $pqa_assessors_educational_background->field_of_study : '') }}">
                <div class="help-block text-center" id="field_of_study-error">

                </div>
            </div>

            <div class="form-group">
                <label for="">Degree <span class="text-danger">*</span></label> 
                <input type="text" class="form-control" placeholder="Degree Obtained" data-id="degree" name="degree" id="degree" value="{{ ($pqa_assessors_educational_background ? $pqa_assessors_educational_background->degree : '') }}">
                <div class="help-block text-center" id="degree-error">

                </div>
            </div>
            
            <div class="form-group">
                <label for="">Year Obtained <span class="text-danger">*</span></label> 
                <input type="text" class="form-control date-picker" placeholder="Year Obtained" data-id="year_obtained" name="year_obtained" id="year_obtained" value="{{ ($pqa_assessors_educational_background ? $pqa_assessors_educational_background->year_obtained : '') }}">
                <div class="help-block text-center" id="year_obtained-error">

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
        <button type="button" class="btn btn-primary js-save_education_info">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->