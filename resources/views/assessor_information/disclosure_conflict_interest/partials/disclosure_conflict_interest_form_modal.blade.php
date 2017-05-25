
<div class="modal fade" tabindex="-1" role="dialog" id="assessors_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ ($pqa_assessors_interest_conflict_disclosure ? 'Update Data' : 'Add Data') }}</h4>
      </div>
      <div class="modal-body">
        <form action="" id="frm_data">
            {{ csrf_field() }}
            <input type="hidden" name="type" value="{{ ($pqa_assessors_interest_conflict_disclosure ? '1' : '0') }}">
            <input type="hidden" id="id" name="id" value="{{ ( $pqa_assessors_interest_conflict_disclosure ? encrypt($pqa_assessors_interest_conflict_disclosure->id) : encrypt(-1)) }}">
            
            <div class="help-block text-center" id="type-error">

            </div>
            <div class="help-block text-center" id="id-error">

            </div>
            <div class="help-block text-center" id="general-error">

            </div>

            <div class="form-group">
                <label for="">Organization <span class="text-danger">*</span></label> 
                <input type="text" class="form-control" data-id="organizations" placeholder="Organization" name="organizations" id="organizations" value="{{ ($pqa_assessors_interest_conflict_disclosure ? $pqa_assessors_interest_conflict_disclosure->organizations : '') }}">
                <div class="help-block text-center" id="organizations-error">

                </div>
            </div>
            
            <div class="form-group">
                <label for="">Industry <span class="text-danger">*</span></label> 
                <input type="text" class="form-control" data-id="industries" placeholder="Industry" name="industries" id="industries" value="{{ ($pqa_assessors_interest_conflict_disclosure ? $pqa_assessors_interest_conflict_disclosure->industries : '') }}">
                <div class="help-block text-center" id="industries-error">

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
        <button type="button" class="btn btn-primary js-save_data">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->