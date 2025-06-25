@extends('layouts.admin')
@section('quizzes')
active
@endsection
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <b>{{$collection->curriculum_subject->subject_code}} [{{$collection->curriculum_subject->course->code}}
                {{$collection->curriculum_subject->year}} - {{$collection->curriculum_subject->semester}}]
                &nbsp&nbsp&nbsp&nbsp&nbsp Section : {{$collection->section}}</b>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="text-align: center;margin: 0px;">
                    <p style="margin: 0px;font-size: 20px;font-weight: bold;">{{$collection->name}}</p>
                    <p style="margin: 0px;">Date : <b>{{$collection->date}}</b></p>
                    <p style="margin: 0px;">Description : <b>{{$collection->description}}</b></p>
                    <p style="margin: 0px;">Total Items : <b>{{$collection->items_total}}</b></p>
                </div>
                <div class="col-md-3"></div>
            </div>
            <table class="table table-borderless" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Score</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @isset($students)
                    @foreach($students as $element)
                    <?php 
                            $score = App\ActivityScore::where('activity_id', $collection->id)->where('id_no', $element->id_no)->first();
                        ?>
                    <tr>
                        <td>{{$element->id}}</td>
                        <td>{{$element->lastname}}, {{$element->firstname}} {{$element->middlename}}</td>
                        <td><input type="number" @isset($score) value="{{$score->score}}" @else value="0" @endisset
                                onchange="changeScore(this, {{$element->id_no}}, {{$collection->id}})"
                                max="{{$collection->items_total}}" style="text-align: center;"></td>
                    </tr>
                    @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
function changeScore(inputElement, id_no, quiz_id) {

    var score = inputElement.value;
    var limit = <?php echo $collection->items_total; ?>;

    if (!score) return;

    if (score > limit) {
        swal(
            'INFO',
            'Score must not be greater than ' + limit,
            'info'
        )
        $(inputElement).val(0);
        return;
    }

    if (score < 0) {
        swal(
            'INFO',
            'Score must not be greater than or equal 0',
            'info'
        )
        $(inputElement).val(0);
        return;
    }

    // AJAX request
    $.ajax({
        url: '/activity-upload_score', // URL of the route in Laravel
        type: 'POST',
        data: {
            quiz_id: quiz_id,
            id_no: id_no,
            score: score, // Data to send to the server
            _token: '{{ csrf_token() }}' // CSRF token for Laravel
        },
        success: function(response) {},
        error: function(xhr, status, error) {
            swal(
                'INFO',
                'Score has not been saved successfully',
                'info'
            )
        }
    });
}


$(document).ready(function() {
    @if(Session::has('Inserted'))
    swal(
        'Saved',
        'New Activity added successfully.',
        'success'
    )
    @elseif(Session::has('Uploaded'))
    swal(
        'Uploaded',
        'Curriculum subjects has been uploaded successfully.',
        'success'
    )
    @elseif(Session::has('Archived'))
    swal(
        'Archived',
        'Subject has been moved to archive.',
        'success'
    )
    @elseif(Session::has('Updated'))
    swal("SUCCESS!", "{!! session('Updated') !!}", "success");
    swal(
        'Updated',
        'Curriculum updated successfully.',
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