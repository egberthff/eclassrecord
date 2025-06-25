@extends('layouts.admin')
@section('curriculum')
active
@endsection
@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">
        <b>{{$collection->name}}</b>
        <a href="{{route('addsubjs', $collection->id)}}" class="btn btn-sm btn-success" style="float: right;margin-bottom: 5px;"><i class="bi bi-plus"></i> Add / Update</a>
      </div>
      <div class="card-body">
        <?php 
          $groupedSubjects = [];

          if(isset($subjects)){
            foreach ($subjects as $subject) {
                $year = $subject['year'];
                $semester = $subject['semester'];
                
                // Group by year and semester
                $groupedSubjects[$year][$semester][] = $subject;
            }
            
            // Sort each group by subject name
            // foreach ($groupedSubjects as $year => &$semesters) {
            //     foreach ($semesters as $semester => &$subjectsArray) {
            //         usort($subjectsArray, function ($a, $b) {
            //             return strcmp($a['subject_code'], $b['subject_code']);
            //         });
            //     }
            // }
          }

          //dd($groupedSubjects);

        ?>

        @isset($groupedSubjects)
          @foreach($groupedSubjects as $year => $semesters)
            @foreach($semesters as $semester => $grpsubj)
              <p style="background-color: #c74115; color: white;width: 120px;padding-left: 10px;border-radius: 7px;">Year : {{$year}} Sem : {{$semester}}</p>
              <table class="table table-borderless" style="width: 100%;">
                  <thead>
                      <tr>
                          <th>Subject Code</th>
                          <th>Subject Description</th>
                          <th>Lec Units</th>
                          <th>Lab Units</th>
                          <th>Total Units</th>
                          <th>Pre / CoRequisites</th>
                          <th>MT</th>
                          <th>FT</th>
                          <th>FG</th>
                          <th>RE</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                    @isset($grpsubj)
                      @foreach($grpsubj as $subj)
                        <tr>
                          <td>{{$subj->subject_code}}</td>
                          <td>{{$subj->subject_desc}}</td>
                          <td>{{number_format($subj->lec_units ?? 0, 1)}}</td>
                          <td>{{number_format($subj->lab_units ?? 0, 1)}}</td>
                          <td>{{number_format($subj->total_units ?? 0, 1)}}</td>
                          <td>{{$subj->pre_reqs}}</td>
                          <td>{{$subj->mt}}</td>
                          <td>{{$subj->ft}}</td>
                          <td>{{$subj->fg}}</td>
                          <td>{{$subj->re}}</td>
                          <td><a href="{{route('removesubj', $subj->id)}}" title="REMOVE">
                                <i class="bi bi-trash-fill" style="color: red;"></i>
                              </a>
                          </td>
                        </tr>
                      @endforeach
                    @endisset
                        <tr>
                          <td></td>
                          <td style="text-align: right;">Sub Total:</td>
                          <td>{{number_format(array_sum(array_column($grpsubj, 'lec_units')) ?? 0, 1)}}</td>
                          <td>{{number_format(array_sum(array_column($grpsubj, 'lab_units')) ?? 0, 1)}}</td>
                          <td>{{number_format(array_sum(array_column($grpsubj, 'total_units')) ?? 0, 1)}}</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                  </tbody>
              </table>

              <br>
            @endforeach
          @endforeach
        @endisset
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script type="text/javascript">
      $.validate();
  </script>
  <script>
      $(document).ready(function(){
          @if(  Session::has('Inserted') )
            swal(
              'Saved',
              'New Curriculum added successfully.',
              'success'
            )
          @elseif( Session::has('Uploaded') )
            swal(
              'Uploaded',
              'Curriculum subjects has been uploaded successfully.',
              'success'
            )
          @elseif( Session::has('Archived') )
            swal(
              'Archived',
              'Subject has been moved to archive.',
              'success'
            )
          @elseif( Session::has('Updated') )
            swal("SUCCESS!", "{!! session('Updated') !!}", "success"); swal(
              'Updated',
              'Curriculum updated successfully.',
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