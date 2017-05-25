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