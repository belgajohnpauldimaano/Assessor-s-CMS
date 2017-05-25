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
@if($pqa_assessors_trainings)
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