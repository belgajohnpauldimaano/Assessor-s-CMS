
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Name of University</th>
            <th>Field of Study</th>
            <th>Degree</th>
            <th>Year Obtained</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @if($pqa_assessors_educational_background)
        @foreach($pqa_assessors_educational_background as $education)
            <tr>
                <td>{{ $education->university_name }}</td>
                <td>{{ $education->field_of_study }}</td>
                <td>{{ $education->degree }}</td>
                <td>{{ $education->year_obtained }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-md dropdown-toggle" data-toggle="dropdown">
                            Options
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="#" class="js-update_education" data-id="{{ encrypt($education->id) }}">Update</a>
                            </li>
                            <li>
                                <a href="#" class="js-delete_education" data-id="{{ encrypt($education->id) }}">Delete</a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    @else
        <tr><td colspan="5">No Data Found</td></tr>
    @endif
    </tbody>
</table>