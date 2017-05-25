
<div class="modal fade" tabindex="-1" role="dialog" id="assessors_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ ($pqa_assessors_employment_record ? 'Update Employment Record' : 'Add Employment Record') }}</h4>
      </div>
      <div class="modal-body">
        <form action="" id="frm_employment_record">
            {{ csrf_field() }}
            <input type="hidden" name="type" value="{{ ($pqa_assessors_employment_record ? '1' : '0') }}">
            <input type="hidden" id="id" name="id" value="{{ ( $pqa_assessors_employment_record ? encrypt($pqa_assessors_employment_record->id) : encrypt(-1)) }}">
            
            <div class="help-block text-center" id="type-error">

            </div>
            <div class="help-block text-center" id="id-error">

            </div>
            <div class="help-block text-center" id="general-error">

            </div>

            <div class="form-group">
                <label for="">Designation <span class="text-danger">*</span></label> 
                <input type="text" class="form-control" placeholder="Designation" data-id="designation" name="designation" id="designation" value="{{ ($pqa_assessors_employment_record ? $pqa_assessors_employment_record->designation : '') }}">
                <div class="help-block text-center" id="designation-error">

                </div>
            </div>

            <div class="form-group">
                <label for="">Company <span class="text-danger">*</span></label> 
                <input type="text" class="form-control" placeholder="Company" data-id="company" name="company" id="company" value="{{ ($pqa_assessors_employment_record ? $pqa_assessors_employment_record->company : '') }}">
                <div class="help-block text-center" id="company-error">

                </div>
            </div>

            <div class="form-group">
                <label for="">Parent Company</label> 
                <input type="text" class="form-control" placeholder="Parent Company" data-id="parent_company" name="parent_company" id="parent_company" value="{{ ($pqa_assessors_employment_record ? $pqa_assessors_employment_record->parent_company : '') }}">
                <div class="help-block text-center" id="parent_company-error">

                </div>
            </div>

            <div class="form-group">
                <label for="">Address <span class="text-danger">*</span></label> 
                <input type="text" class="form-control" placeholder="Address" data-id="address" name="address" id="address" value="{{ ($pqa_assessors_employment_record ? $pqa_assessors_employment_record->address : '') }}">
                <div class="help-block text-center" id="address-error">

                </div>
            </div>
            
            <div class="form-group">

                <div class="row">
                    <div class="col-sm-6">
                        <label for="">Date of Service <span class="text-danger">*</span></label> 
                        <input type="text" placeholder="mm/dd/yyyy" class="form-control dateservice" data-id="date_of_service" name="date_of_service" id="date_of_service" value="{{ ($pqa_assessors_employment_record ? Date('m-d-Y', strtotime($pqa_assessors_employment_record->date_of_service)) : '') }}">
                        <div class="help-block text-center" id="date_of_service-error">

                        </div>
                    </div>
                    <div class="col-sm-6">

                        <?php
                            $options = ['Full time', 'Part time', 'Resigned/Retired'];
                        ?>

                        <label for="">Status <span class="text-danger">*</span></label> 
                        <div class="form-group">
                            <select name="status" data-id="status" id="status" class="form-control">
                                @foreach($options as $key => $option)
                                    <option value="{{ $key }}" <?php echo ($pqa_assessors_employment_record ? ($pqa_assessors_employment_record->employment_status == $key ? 'selected' : '') : '') ; ?> >
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="help-block text-center" id="status-error">

                        </div>
                    </div>
                </div>

            </div>
            
            <div class="form-group">
                <label for="">Telephone No. <span class="text-danger">*</span></label> 
                <input type="text" placeholder="Telephone No." class="form-control" data-id="tel_no" name="tel_no" id="tel_no" value="{{ ($pqa_assessors_employment_record ? $pqa_assessors_employment_record->tel_no : '') }}">
                <div class="help-block text-center" id="tel_no-error">

                </div>
            </div>
            
            <div class="form-group">
                <label for="">Fax No. <span class="text-danger">*</span></label> 
                <input type="text" placeholder="Fax No." class="form-control" data-id="fax_no" name="fax_no" id="fax_no" value="{{ ($pqa_assessors_employment_record ? $pqa_assessors_employment_record->fax_no : '') }}">
                <div class="help-block text-center" id="fax_no-error">

                </div>
            </div>
            
            <div class="form-group">
                <label for="">Email Address <span class="text-danger">*</span></label> 
                <input type="text" placeholder="Email Address" class="form-control" data-id="email_address" name="email_address" id="email_address" value="{{ ($pqa_assessors_employment_record ? $pqa_assessors_employment_record->email_address : '') }}">
                <div class="help-block text-center" id="email_address-error">

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
        <button type="button" class="btn btn-primary js-employment_record">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->