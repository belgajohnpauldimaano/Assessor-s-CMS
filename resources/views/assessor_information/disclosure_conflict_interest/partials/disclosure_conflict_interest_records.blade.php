@if($pqa_assessors_interest_conflict_disclosure->count() > 0)
    @foreach($pqa_assessors_interest_conflict_disclosure as $data)
        <tr>
            <td>{{ $data->organizations }}</td>
            <td>{{ $data->industries }}</td>
            <td>
                <?php
                    $id = encrypt($data->id);
                ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-md dropdown-toggle" data-toggle="dropdown">
                        Options
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <?php $id = encrypt($data->id); ?>
                        <li>
                            <a href="#" class="js-update_data" data-id="{{ $id }}">Update</a>
                        </li>
                        <li>
                            <a href="#" class="js-delete_data" data-id="{{ $id }}">Delete</a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="3">No data found.</td>
    </tr>
@endif