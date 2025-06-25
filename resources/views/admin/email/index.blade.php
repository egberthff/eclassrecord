@extends('layouts.admin')
@section('create_email')
active
@endsection
@section('head')
    <style>
        .margin-0rem{
            margin-bottom: 0rem !important;
        }
        .fsize_15{
            font-size: 15px !important;
        }
        .fsize_12{
            font-size: 12px !important;
        }
        table thead tr th{
            font-weight: normal;
        }
    </style>
@endsection
@section('content')
<section class="welcome p-t-30 p-b-10" >
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title-3">Send Email
            </h1>
        </div>
    </div>
</div>
</section>

<div class="row">
    <div class="col-md-4" style="padding-top: 10px;padding-left: 25px;">
        <div class="form-group" style="margin-top: -10px;">
            <?php 
            $subjs = App\CurriculumSubject::where('faculty_id', Auth::user()->email)->get();
            ?>
            <label class=" form-control-label">Current Subject </label>
            <select class="form-control select2" name="curriculum_subject_id" id="company" aria-required="true" aria-invalid="false" data-validation="required" style="font-weight: bold;" onchange="handleChange(this.value)">
            @isset($subjs)
                @foreach($subjs as $subj)
                <option value="{{$subj->id}}" @if($subj_activ != '' && $subj->id == $subj_activ) selected @endif>{{$subj->course->code}} [Year : {{$subj->year}} Sem : {{$subj->semester}}] {{$subj->subject_code}}</option>
                @endforeach
            @endisset
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class=" form-control-label">Section</label>
            <select class="form-control select2" name="section" id="company" aria-required="true" aria-invalid="false" data-validation="required" style="font-weight: bold;" onchange="handleChangeSection(this.value)">
                <option value="">Select Section</option>
                @isset($sections)
                    @foreach($sections as $section)
                    <option value="{{$section->section}}" @if($section_activ != '' && $section->section == $section_activ) selected @endif>{{$section->section}}</option>
                    @endforeach
                @endisset
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class=" form-control-label">Select Student/s</label>
            <select id="students" class="form-control js-example-basic-multiple" name="students[]" multiple="multiple" name="section" id="company" aria-required="true" aria-invalid="false" data-validation="required" style="font-weight: bold;">
                <option value="all">All</option>
                @isset($students)
                    @foreach($students as $element)
                    <option value="{{$element->email}}">{{$element->user->name}}</option>
                    @endforeach
                @endisset
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6" style="padding-top: 10px;padding-left: 25px;">
        <div class="form-group">
            <label class=" form-control-label">Subject <span style="color: red; font-weight: bold;">*</span></label>
            <input type="text" id="subject" class="form-control" name="subject">
        </div>
        <div class="form-group">
            <label class=" form-control-label">Body <span style="color: red; font-weight: bold;">*</span></label>
            <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <br>
        <div class="form-group">
            <a href="#" id="createmail" class="btn btn-primary">Create Email</a>
        </div>
    </div>
</div>

@endsection
@section('scripts')
  <script>
        document.getElementById('createmail').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent link from navigating
            const selectElement = document.getElementById('students');
            const subject = document.getElementById('subject').value;
            let body = document.getElementById('body').value;
            const selectedOptions = Array.from(selectElement.selectedOptions).map(option => option.value);
            
            let emailAddresses = [];

            // Simple email validation regex
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (selectedOptions.includes('all')) {
                // If "All" is selected, get all student emails except "All" and validate each email
                emailAddresses = Array.from(selectElement.options)
                                    .filter(option => option.value !== 'all' && emailPattern.test(option.value))
                                    .map(option => option.value);
            } else {
                // Use only selected emails if "All" is not selected, and validate each email
                emailAddresses = selectedOptions.filter(email => emailPattern.test(email));
            }

            // Encode body content to replace spaces with '%20' and newlines with '%0A'
            if (body) {
                body = body.replace(/\n/g, '%0A').replace(/ /g, '%20');
            }

            // Generate mailto link with selected and valid email addresses
            if (emailAddresses.length > 0) {
                let mailtoLink = `mailto:${emailAddresses.join(',')}`;
                if (subject) {
                    mailtoLink += `?subject=${encodeURIComponent(subject)}`;
                    if (body) {
                        mailtoLink += `&body=${body}`;
                    }
                }
                window.location.href = mailtoLink;
            } else {
                $('#students').val(null).trigger('change');
                swal(
                    'INFO',
                    'There is no email for this student.',
                    'info'
                );
            }
        });


      function handleChange(selectedValue) {
        // Check if a value is selected
        if (!selectedValue) return;

        // AJAX request
        $.ajax({
            url: '/handle-change', // URL of the route in Laravel
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
        if (!selectedValue) return;

        // AJAX request
        $.ajax({
            url: '/handle-change-section', // URL of the route in Laravel
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


      $(document).ready(function(){
        $('.js-example-basic-multiple').select2({
            placeholder: 'Select Student/s'
        });

          $('a.btnDel').click(function (event) {
              event.preventDefault();
              swal({
                  title: 'CONFIRM ACTION!',
                  text: 'Are you sure you want to delete this record?',
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'DELETE',
                  reverseButtons: true,
                  focusConfirm: false,
              }).then((result) => {
                  if(result.value){
                  $(this).parent().find('.formDelete').submit();
              }
          });
          });
          @if(  Session::has('Inserted') )
            swal(
              'Saved',
              'New Quiz added successfully.',
              'success'
            )
         @elseif(  Session::has('CourseTerm_Updated') )
            swal(
              'Saved',
              'Course Term has been updated successfully.',
              'success'
            )
          @elseif( Session::has('Activated') )
            swal(
              'Activated',
              'Quiz has been removed from archive successfuly.',
              'success'
            )
          @elseif( Session::has('Archived') )
            swal(
              'Deleted',
              'Quiz has been added to archive.',
              'success'
            )
          @elseif( Session::has('Deleted') )
            swal(
              'Deleted',
              'Quiz deleted successfully.',
              'success'
            )
          @elseif( Session::has('Updated') )
            swal("SUCCESS!", "{!! session('Updated') !!}", "success"); swal(
              'Updated',
              'Quiz updated successfully.',
              'success'
            )
          @elseif( Session::has('Error') )
            swal(
              'INFO',
              'Unable to delete, this record is used.',
              'info'
            )
          @elseif( Session::has('Duplicate') )
            swal('Duplicate Record.', 'This record already exist.', 'info');
          @endif
      });
  </script>
@endsection