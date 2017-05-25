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