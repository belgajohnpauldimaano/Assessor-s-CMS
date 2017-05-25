
<div class="modal fade" tabindex="-1" role="dialog" id="assessors_training_info">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ ($pqa_assessors_trainings ? 'Update Training Information' : 'Add Training Information') }}</h4>
      </div>
      <div class="modal-body">
        <form action="" id="frm_training_info">
            {{ csrf_field() }}
            <input type="hidden" name="type" value="{{ ($pqa_assessors_trainings ? '1' : '0') }}">
            <input type="hidden" id="id" name="id" value="{{ ( $pqa_assessors_trainings ? encrypt($pqa_assessors_trainings->id) : encrypt(-1)) }}">
            
            <div class="help-block text-center" id="type-error">

            </div>
            <div class="help-block text-center" id="id-error">

            </div>
            <div class="help-block text-center" id="general-error">

            </div>

            <div class="form-group">
                <label for="">Course <span class="text-danger">*</span></label> 
                <input type="text" class="form-control" placeholder="Course" data-id="course" name="course" id="course" value="{{ ($pqa_assessors_trainings ? $pqa_assessors_trainings->course : '') }}">
                <div class="help-block text-center" id="course-error">

                </div>
            </div>
            
            <div class="form-group">
                <label for="">Provider <span class="text-danger">*</span></label> 
                <input type="text" class="form-control" placeholder="Course Provider" data-id="provider" name="provider" id="provider" value="{{ ($pqa_assessors_trainings ? $pqa_assessors_trainings->provider : '') }}">
                <div class="help-block text-center" id="provider-error">

                </div>
            </div>
            
            <div class="form-group">
                <label for="">Date From <span class="text-danger">*</span></label> 
                <input type="text" class="form-control date_duration" placeholder="mm/dd/yyyy" data-id="date_from" name="date_from" id="date_from" value="{{ ($pqa_assessors_trainings ? date('m/d/Y', strtotime($pqa_assessors_trainings->date_from)) : '') }}">
                <div class="help-block text-center" id="date_from-error">

                </div>
            </div>
            
            <div class="form-group">
                <label for="">Date To <span class="text-danger">*</span></label> 
                <input type="text" class="form-control date_duration" placeholder="mm/dd/yyyy" data-id="date_to" name="date_to" id="date_to" value="{{ ($pqa_assessors_trainings ? date('m/d/Y', strtotime($pqa_assessors_trainings->date_to)) : '') }}">
                <div class="help-block text-center" id="date_to-error">

                </div>
            </div>

        </form>
      </div>
      <div class="modal-footer"><div class="pull-left">
            <p class="text-danger">
                All fields with an asterisk (*) are required.
            </p>
        </div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary js-training_info">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->