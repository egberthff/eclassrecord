@extends('layouts.admin')
@section('students')
active
@endsection
@section('content')
<div class="container-fluid">
    <div class="pull-right" style="padding-right: 2px;padding-top: 20px;padding-bottom: 5px;">
        <a href="{{route('add_student')}}" class="btn btn-success" style="font-size: 12px; padding: 4px;">
            <i class="fa fa-plus"></i> Add Student</a>
        <a href="{{route('students.create')}}" class="btn btn-success" style="font-size: 12px; padding: 4px;">
            <i class="fa fa-arrow-up"></i> Upload Students</a>
        <a href="{{route('update_sections')}}" class="btn btn-success" style="font-size: 12px; padding: 4px;">
            <i class="fa fa-arrow-up"></i> Update Sections</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="form-group">
                <label for="cc-payment" class="control-label" style="color: black !important;"><i
                        class="bi bi-filter fs-5"></i>Course</label>
                <select id="course_id" class="form-control" name="course_id" aria-required="true" aria-invalid="false"
                    data-validation="required" onchange="handleChangeCourse(this.value)">
                    <option value="">Choose option</option>
                    <?php $courses = App\Course::where('status', 1)->get()?>
                    @isset($courses)
                    @foreach($courses as $course)
                    <option value="{{$course->id}}" @isset(Auth::user()->course_active) @if(Auth::user()->course_active
                        == $course->id) selected @endif @endisset>{{$course->course}}</option>
                    @endforeach
                    @endisset
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="color: black !important;"><i class="bi bi-filter fs-5"></i>Year
                    Level </label>
                <select id="yearlevel" class="form-control" name="yearlevel" aria-required="true" aria-invalid="false"
                    data-validation="required" onchange="handleChangeYearlevel(this.value)">
                    <option value="">Choose option</option>
                    <option value="1" @isset(Auth::user()->yearlevel_active) @if(Auth::user()->yearlevel_active == '1')
                        selected @endif @endisset>1</option>
                    <option value="2" @isset(Auth::user()->yearlevel_active) @if(Auth::user()->yearlevel_active == '2')
                        selected @endif @endisset>2</option>
                    <option value="3" @isset(Auth::user()->yearlevel_active) @if(Auth::user()->yearlevel_active == '3')
                        selected @endif @endisset>3</option>
                    <option value="4" @isset(Auth::user()->yearlevel_active) @if(Auth::user()->yearlevel_active == '4')
                        selected @endif @endisset>4</option>
                    <option value="5" @isset(Auth::user()->yearlevel_active) @if(Auth::user()->yearlevel_active == '5')
                        selected @endif @endisset>5</option>
                </select>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="color: black !important;"><i class="bi bi-filter fs-5"></i>Section
                </label>
                <select id="section" class="form-control" name="semester" aria-required="true" aria-invalid="false"
                    data-validation="required" onchange="handleChangeSection(this.value)">
                    <option value="">Choose option</option>
                    @isset($sections)
                    @foreach($sections as $section)
                    <option value="{{$section}}" @isset(Auth::user()->section_active) @if(Auth::user()->section_active
                        == $section) selected @endif @endisset>{{$section}}</option>
                    @endforeach
                    @endisset
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group" style="margin-top: 25px;">
                <a href="#" class="btn btn-success" id="exportExcel"><i class="bi bi-download"></i> Export</a>
            </div>
        </div>
    </div>
    <div class="custom-tab">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Active</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Archive</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="table-responsive m-b-40">
                    <table id="tablestud1" class="table table-borderless table-data3" style="width: 100%;">
                        <thead style="background-color: #330066;">
                            <th width="10%" style="font-size: 12px; color: white;">ID No.</th>
                            <th width="15%" style="font-size: 12px; color: white;">Name</th>
                            <th width="10%" style="font-size: 12px; color: white;">College</th>
                            <th width="5%" style="font-size: 12px; color: white;">Course</th>
                            <th width="5%" style="font-size: 12px; color: white;">Level</th>
                            <th width="5%" style="font-size: 12px; color: white;">Section</th>
                            <th width="10%" style="font-size: 12px; color: white;">Access Key</th>
                            <th width="5%" style="font-size: 12px; color: white;">Sex</th>
                            <th width="10%" style="font-size: 12px; color: white;">Address</th>
                            <th width="5%" style="font-size: 12px; color: white;">Birthdate</th>
                            <th width="5%" style="font-size: 12px; color: white;">Units</th>
                            <td width="5%" style="font-size: 12px; color: white;">Email</td>
                            <th width="10%" style="font-size: 12px; color: white;">Action</th>
                        </thead>
                        <tbody>
                            @isset($model)
                            @foreach($model as $element)
                            <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                                <td>{{$element->id_no}}</td>
                                <td>{{$element->lastname}}, {{$element->firstname}} {{$element->middlename}}</td>
                                <td>{{$element->course->college->name}}</td>
                                <td>{{$element->course->code}}</td>
                                <td>{{$element->yearlevel}}</td>
                                <td>{{$element->section}}</td>
                                <td>{{$element->access_key}}</td>
                                <td>{{$element->sex}}</td>
                                <td>{{$element->address}}</td>
                                <td>{{Carbon\Carbon::parse($element->dateofbirth)->toDateString()}}</td>
                                <td>{{$element->units}}</td>
                                <td>{{$element->email}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        @if($element->status == 'REGULAR' || $element->status == 'IRREGULAR')
                                        <a href="{{route('students.edit', $element->id)}}" style="margin-top: 10px;"
                                            class="item" data-toggle="tooltip" data-placement="top" title="EDIT">
                                            <i class="fs-5 bi bi-pencil-fill" style="color: blue;"></i>
                                        </a>
                                        <b style="color: green;">
                                            <a href="{{route('students.destroy', $element->id)}}"
                                                style="margin-top: 10px;" class="item" data-toggle="tooltip"
                                                data-placement="top" title="Put in ARCHIVE">
                                                <i class="fs-5 bi bi-trash-fill" style="color: red;"></i>
                                            </a>
                                        </b>
                                        @else
                                        <a href="{{route('students.destroy', $element->id)}}" style="margin-top: 10px;"
                                            class="item btnAct" data-toggle="tooltip" data-placement="top"
                                            title="Remove from ARCHIVE">
                                            <i class="fs-5 bi bi-trash-fill" style="color: green;"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive m-b-40">
                    <table id="tablestud2" class="table table-borderless table-data3" style="width: 100%;">
                        <thead style="background-color: #330066;">
                            <th width="10%" style="font-size: 12px; color: white;">ID No.</th>
                            <th width="15%" style="font-size: 12px; color: white;">Name</th>
                            <th width="10%" style="font-size: 12px; color: white;">College</th>
                            <th width="5%" style="font-size: 12px; color: white;">Course</th>
                            <th width="5%" style="font-size: 12px; color: white;">Level</th>
                            <th width="5%" style="font-size: 12px; color: white;">Section</th>
                            <th width="10%" style="font-size: 12px; color: white;">Access Key</th>
                            <th width="5%" style="font-size: 12px; color: white;">Sex</th>
                            <th width="10%" style="font-size: 12px; color: white;">Address</th>
                            <th width="5%" style="font-size: 12px; color: white;">Birthdate</th>
                            <th width="5%" style="font-size: 12px; color: white;">Units</th>
                            <td width="5%" style="font-size: 12px; color: white;">Email</td>
                            <th width="10%" style="font-size: 12px; color: white;">Action</th>
                        </thead>
                        <tbody>
                            @isset($inactive)
                            @foreach($inactive as $element)
                            <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                                <td>{{$element->id_no}}</td>
                                <td>{{$element->lastname}}, {{$element->firstname}} {{$element->middlename}}</td>
                                <td>{{$element->course->college->name}}</td>
                                <td>{{$element->course->code}}</td>
                                <td>{{$element->yearlevel}}</td>
                                <td>{{$element->section}}</td>
                                <td>{{$element->access_key}}</td>
                                <td>{{$element->sex}}</td>
                                <td>{{$element->address}}</td>
                                <td>{{Carbon\Carbon::parse($element->dateofbirth)->toDateString()}}</td>
                                <td>{{$element->units}}</td>
                                <td>{{$element->email}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        @if($element->status == 'REGULAR' || $element->status == 'IRREGULAR')
                                        <a href="{{route('students.edit', $element->id)}}" style="margin-top: 10px;"
                                            class="item" data-toggle="tooltip" data-placement="top" title="EDIT">
                                            <i class="fs-5 bi bi-pencil-fill" style="color: blue;"></i>
                                        </a>
                                        <b style="color: green;">
                                            <a href="{{route('students.destroy', $element->id)}}"
                                                style="margin-top: 10px;" class="item" data-toggle="tooltip"
                                                data-placement="top" title="Put in ARCHIVE">
                                                <i class="fs-5 bi bi-trash-fill" style="color: red;"></i>
                                            </a>
                                        </b>
                                        @else
                                        <a href="{{route('students.destroy', $element->id)}}" style="margin-top: 10px;"
                                            class="item btnAct" data-toggle="tooltip" data-placement="top"
                                            title="Remove from ARCHIVE">
                                            <i class="fs-5 bi bi-trash-fill" style="color: green;"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


</div>
@endsection


@section('scripts')
<script>
function handleChangeCourse(selectedValue) {
    // Check if a value is selected

    // AJAX request
    $.ajax({
        url: '/handle-change-course', // URL of the route in Laravel
        type: 'POST',
        data: {
            value: selectedValue, // Data to send to the server
            _token: '{{ csrf_token() }}' // CSRF token for Laravel
        },
        success: function(response) {
            // Refresh the page after the AJAX request is successful
            window.location.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        }
    });
}

function handleChangeYearlevel(selectedValue) {
    // Check if a value is selected

    // AJAX request
    $.ajax({
        url: '/handle-change-yearlevel', // URL of the route in Laravel
        type: 'POST',
        data: {
            value: selectedValue, // Data to send to the server
            _token: '{{ csrf_token() }}' // CSRF token for Laravel
        },
        success: function(response) {
            // Refresh the page after the AJAX request is successful
            window.location.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        }
    });
}

function handleChangeSection(selectedValue) {
    // Check if a value is selected

    // AJAX request
    $.ajax({
        url: '/handle-change-sections', // URL of the route in Laravel
        type: 'POST',
        data: {
            value: selectedValue, // Data to send to the server
            _token: '{{ csrf_token() }}' // CSRF token for Laravel
        },
        success: function(response) {
            // Refresh the page after the AJAX request is successful
            window.location.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        }
    });
}
var tableactive = $('#tablestud1').DataTable({
    pageLength: 100
});

document.getElementById('exportExcel').addEventListener('click', function() {
    // Get the table element
    var table = document.getElementById('tablestud1');
    var csv = [];
    
    // Define the columns we want to export (0-based index)
    var columnsToExport = [0, 1, 2, 3, 4, 5, 7, 8, 9, 10, 11]; // Indices of columns to export
    var headerRow = [];

    // Add the headers to the CSV
    for (var j = 0; j < columnsToExport.length; j++) {
        headerRow.push(escapeCSVValue(table.rows[0].cells[columnsToExport[j]].innerText));
    }
    csv.push(headerRow.join(",")); // Add header row to CSV

    // Loop through the rows of the table, starting from 1 to skip header
    for (var i = 1; i < table.rows.length; i++) {
        var row = [];
        for (var j = 0; j < columnsToExport.length; j++) {
            // Get the text content of the specified cells
            var cellValue = table.rows[i].cells[columnsToExport[j]] ? 
                            table.rows[i].cells[columnsToExport[j]].innerText.trim() : '';

            // Push escaped cell value or empty string if cell is undefined
            row.push(escapeCSVValue(cellValue));
        }
        csv.push(row.join(",")); // Join each row's cells with commas
    }
    
    // Create a CSV string
    var csvString = csv.join("\n");
    
    // Create a Blob from the CSV string
    var blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });

    // Create a link to download the Blob
    var link = document.createElement("a");
    var url = URL.createObjectURL(blob);
    link.setAttribute("href", url);
    link.setAttribute("download", "student_data.csv"); // Set the name for the downloaded file
    link.style.visibility = 'hidden';
    
    // Append the link to the body
    document.body.appendChild(link);
    link.click(); // Trigger the download
    document.body.removeChild(link); // Clean up by removing the link
});

// Function to escape CSV values
function escapeCSVValue(value) {
    if (value.includes('"')) {
        // Replace double quotes with two double quotes
        value = value.replace(/"/g, '""');
    }
    // Wrap the value in double quotes if it contains a comma or a double quote
    if (value.includes(',') || value.includes('"') || value.includes('\n')) {
        value = `"${value}"`;
    }
    return value;
}




$('#tablestud2').DataTable({
    "pageLength": 100
});
$(document).ready(function() {

    // $('a.btnDel').click(function (event) {
    //     event.preventDefault();
    //     swal({
    //         title: 'CONFIRM ACTION!',
    //         text: 'Are you sure you want to delete this record?',
    //         type: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#d33',
    //         cancelButtonColor: '#3085d6',
    //         confirmButtonText: 'DELETE',
    //         reverseButtons: true,
    //         focusConfirm: false,
    //     }).then((result) => {
    //         if(result.value){
    //         $(this).parent().find('.formDelete').submit();
    //     }
    // });
    // });
    @if(Session::has('Inserted'))
    swal(
        'Saved',
        'Students has been added successfully.',
        'success'
    )
    @elseif(Session::has('Activated'))
    swal(
        'Activated',
        'Student has been removed from archive successfuly.',
        'success'
    )
    @elseif(Session::has('Archived'))
    swal(
        'Deleted',
        'Student has been added to archive.',
        'success'
    )
    @elseif(Session::has('Deleted'))
    swal(
        'Deleted',
        'Student has been deleted successfully.',
        'success'
    )
    @elseif(Session::has('Updated'))
    swal("SUCCESS!", "{!! session('Updated') !!}", "success");
    swal(
        'Updated',
        'Student has been updated successfully.',
        'success'
    )
    @elseif(Session::has('UpdatedSections'))
    swal(
        'Updated',
        'Students section has been updated successfully.',
        'success'
    )
    @elseif(Session::has('Error'))
    swal(
        'INFO',
        'Unable to delete, this record is used.',
        'info'
    )
    @elseif(Session::has('Duplicate'))
    swal('Duplicate Record.', 'This record already exist.', 'info');
    @endif
});
</script>
@endsection