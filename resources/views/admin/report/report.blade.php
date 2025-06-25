<!DOCTYPE html>
<html>
<head>
  <title>FACULTY PERFORMANCE EVALUATION</title>
    <link rel="icon" type="text/css" href="{{URL::to('logo.png')}}"></head>

    <!-- Bootstrap CSS-->
    <link href="{{URL::to('admin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
    <style>
        .century_gothic{
            font-family:  Arial, sans-serif;;
        }
        .cambria{
            font-family:  Arial, sans-serif;;
        }
        .calibri{
            font-family: Arial, sans-serif;; 
        }
        .margin-0rem{
            margin-bottom: 0rem;
        }
        .fsize_15{
            font-size: 15px;
        }
        .checkbox-wrapper-28 label{
            font-family:  Arial, sans-serif;;
        }

        .table td, .table th {
            padding: .0rem;
        }

    </style>

    <style>
    .checkbox-wrapper-28 {
        --size: 25px;
        position: relative;
    }

    .checkbox-wrapper-28 *,
    .checkbox-wrapper-28 *:before,
    .checkbox-wrapper-28 *:after {
        box-sizing: border-box;
    }

    .checkbox-wrapper-28 .promoted-input-checkbox {
        border: 0;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
    }

    .checkbox-wrapper-28 input:checked ~ svg {
        height: calc(var(--size) * 0.6);
        -webkit-animation: draw-checkbox-28 ease-in-out 0.2s forwards;
                animation: draw-checkbox-28 ease-in-out 0.2s forwards;
    }
    .checkbox-wrapper-28 label:active::after {
        background-color: #e6e6e6;
    }
    .checkbox-wrapper-28 label {
        color: black;
        line-height: var(--size);
        cursor: pointer;
        position: relative;
    }
    .checkbox-wrapper-28 label:after {
        content: "";
        height: var(--size);
        width: var(--size);
        margin-right: 8px;
        float: left;
        border: 2px solid black;
        border-radius: 3px;
        transition: 0.15s all ease-out;
    }
    .checkbox-wrapper-28 svg {
        stroke: black;
        stroke-width: 3px;
        height: 0;
        width: calc(var(--size) * 0.6);
        position: absolute;
        left: calc(var(--size) * 0.21);
        top: calc(var(--size) * 0.2);
        stroke-dasharray: 33;
    }

    @-webkit-keyframes draw-checkbox-28 {
        0% {
        stroke-dashoffset: 33;
        }
        100% {
        stroke-dashoffset: 0;
        }
    }

    @keyframes draw-checkbox-28 {
        0% {
        stroke-dashoffset: 33;
        }
        100% {
        stroke-dashoffset: 0;
        }
    }
    </style>



<body>

    

    <div style="height: 1500px;">
        <div class="container-fluid row pull-center">
            <div class="col-md-3" style="text-align: left;margin-left: 200px;">
                <img src="{{URL::to('logo.png')}}" style="width: 100px;height:100px;" alt="">
            </div>
            <div class="col-md-6" style="text-align: center;margin-top: -85px;">
                <p class="cambria margin-0rem fsize_15">Republic of the Philippines</p>
                <p class="cambria margin-0rem fsize_15" style="font-weight: bold;">BOHOL ISLAND STATE UNIVERSITY</p>
                <p class="cambria margin-0rem fsize_15">Balilihan Campus Magsija, Balilihan, Bohol</p>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="container-fluid">
            <p class="century_gothic" style="font-style: italic;margin-bottom: 0em;font-size: 14px;"><b>Vision:</b> A premier S& T University for the formation of a world class and virtue-laden human resource for sustainable development in Bohol and the Country.</p>
            <p class="century_gothic" style="font-style: italic;margin-bottom: 0em;font-size: 14px;"><b>Mission:</b> BISU is committed to provide quality higher education in the arts and sciences, as well as in the professional and technological fields; undertake research</p>
            <p class="century_gothic" style="text-align: center;font-style: italic;font-size: 14px;">and development, and extension services for the sustainable development of Bohol and the country.</p>
            <hr style="border: 1px solid;">
            <p class="cambria margin-0rem" style="text-align: center;font-weight: bold;margin-bottom: 0em;">{{$college->description}}</p>
            <p class="cambria margin-0rem" style="text-align: center;font-weight: bold;margin-bottom: 0em;">FACULTY PERFORMANCE EVALUATION</p>
            <p class="cambria margin-0rem" style="text-align: center;font-weight: bold;margin-bottom: 0em;">Academic Year: 2023 - 2024</p>
            
        </div>

        <br>
        <div class="container-fluid">
            <table class="table table-borderless">
                <thead>
                <tr>
                    <th style="text-align: center; font-weight: bold;width: 10%;" class="cambria"></th>
                    <th style="text-align: center; font-weight: bold;width: 40%;" class="cambria"></th>
                    <th style="text-align: center; font-weight: bold;width: 15%;" class="cambria"></th>
                    <th style="text-align: center; font-weight: bold;width: 35%;" class="cambria"></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="cambria" style="text-align: left;">Name:</td>
                        <td class="cambria" style="text-align: left;"><b style="text-transform: Uppercase;"> {{$faculty->lname}}, {{$faculty->fname}} @if($faculty->mname) {{substr($faculty->mname, 0, 1)}}.@endif</b></td>
                        <td class="cambria" style="text-align: left;">Faculty Rank:</td>
                        <td class="cambria" style="text-align: left;"><b>{{$faculty->rank}}</b></td>
                    </tr>
                    <tr>
                        <td class="cambria" style="text-align: left;">Department:</td>
                        <td class="cambria" style="text-align: left;"><b>{{$college->description}}</b></td>
                        <td class="cambria" style="text-align: left;">Period Covered:</td>
                        <td class="cambria" style="text-align: left;"><b>{{$semester}}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <div class="container-fluid">
            <table class="table table-borderless">
                <thead>
                <tr>
                    <th style="text-align: center;width: 10%;" class="cambria">Rater</th>
                    <th style="text-align: center;width: 10%;" class="cambria"></th>
                    <th style="text-align: center;width: 20%;" class="cambria"></th>
                    <th style="text-align: center;width: 30%;" class="cambria">Weight</th>
                    <th style="text-align: center;width: 30%;" class="cambria">Weighted Rating</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="cambria" style="text-align: left;">A. Students</td>
                        <td></td>
                        <td class="cambria" style="text-align: center;border-bottom: 1px solid;">{{$student_evaluations_count}}</td>
                        <td class="cambria" style="text-align: center;">0.60</td>
                        <td class="cambria" style="text-align: center;border-bottom: 1px solid;">{{number_format($weightedRatingsStudents ?? 0, 2)}}</td>
                    </tr>
                    <tr>
                        <td class="cambria" style="text-align: left;">B. Supervisor</td>
                        <td></td>
                        <td class="cambria" style="text-align: center;border-bottom: 1px solid;">1</td>
                        <td class="cambria" style="text-align: center;">0.40</td>
                        <td class="cambria" style="text-align: center;border-bottom: 1px solid;">{{number_format($weightedRatingsSupervisor ?? 0, 2)}}</td>
                    </tr>
                    <tr>
                        <td>&nbsp</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="cambria" style="text-align: left;"></td>
                        <td></td>
                        <td class="cambria" style="text-align: center;"></td>
                        <td class="cambria" style="text-align: center;font-weight: bold;">Numerical Rating</td>
                        <td class="cambria" style="text-align: center;border-bottom: 1px solid;">{{number_format($overallweightedRating ?? 0, 2)}}</td>
                    </tr>
                    <tr>
                        <td class="cambria" style="text-align: left;"></td>
                        <td></td>
                        <td class="cambria" style="text-align: center;"></td>
                        <td class="cambria" style="text-align: center;">(Sum of A, B)</td>
                        <td class="cambria" style="text-align: center;"></td>
                    </tr>
                    <tr>
                        <td class="cambria" style="text-align: left;"></td>
                        <td></td>
                        <td class="cambria" style="text-align: center;"></td>
                        <td class="cambria" style="text-align: center;font-weight: bold;">DESCRIPTIVE RATING</td>
                        <td class="cambria" style="text-align: center;border-bottom: 1px solid;font-weight: bold;">{{$descriptive}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <div class="container-fluid">
            <table class="table table-borderless">
                <thead>
                <tr>
                    <th style="text-align: left;width: 45%;" class="cambria">Shown to me and concurred in:</th>
                    <th style="text-align: left;width: 10%;" class="cambria"></th>
                    <th style="text-align: left;width: 45%;" class="cambria">Reviewed by:</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>&nbsp</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="cambria" style="text-align: center;font-weight: bold;text-transform: Uppercase;">{{$faculty->fname}} @if($faculty->mname) {{substr($faculty->mname, 0, 1)}}.@endif {{$faculty->lname}}</td>
                        <td></td>
                        <td class="cambria" style="text-align: center;font-weight: bold;">{{$college->dean}}</td>
                    </tr>
                    <tr>
                        <td class="cambria" style="border-top: 1px solid;"></td>
                        <td></td>
                        <td class="cambria" style="border-top: 1px solid;"></td>
                    </tr>
                    <tr>
                        <td class="cambria" style="text-align: center;">Ratee's Name and Signature</td>
                        <td></td>
                        <td class="cambria" style="text-align: center;">Name and Signature</td>
                    </tr>
                    <tr>
                        <td>&nbsp</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>&nbsp</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="cambria" style="text-align: center;font-weight: bold;">{{$faculty->rank}}</td>
                        <td></td>
                        <td class="cambria" style="text-align: center;font-weight: bold;">DEAN, {{$college->name}}</td>
                    </tr>
                    <tr>
                        <td class="cambria" style="border-top: 1px solid;"></td>
                        <td></td>
                        <td class="cambria" style="border-top: 1px solid;"></td>
                    </tr>
                    <tr>
                        <td class="cambria" style="text-align: center;">Faculty Rank</td>
                        <td></td>
                        <td class="cambria" style="text-align: center;">Designation</td>
                    </tr>
                    <tr>
                        <td>&nbsp</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>&nbsp</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Approved:</td>
                    </tr>
                    <tr>
                        <td class="cambria" style="text-align: center;font-weight: bold;"></td>
                        <td></td>
                        <td class="cambria" style="text-align: center;font-weight: bold;">{{$settings->campus_director}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="cambria" style="border-top: 1px solid;"></td>
                    </tr>
                    <tr>
                        <td class="cambria" style="text-align: center;"></td>
                        <td></td>
                        <td class="cambria" style="text-align: center;">Campus Director</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <br>
        <div class="container-fluid">
            <table class="table table-borderless">
                <thead>
                <tr>
                    <th style="text-align: left;width: 30%;" class="cambria">Note: Any Additional Remarks</th>
                    <th style="text-align: left;width: 70%;" class="cambria"></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>&nbsp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="padding-left: 50px;">Descriptive Equivalent of Numerical Ratings</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>93 – above &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ---------- &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Outstanding (O)</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>75 – 92 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ---------- &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Very Satisfactory (VS)</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>50 – 74 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ---------- &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Satisfactory (S)</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>30 – 49 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ---------- &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Fair (F)</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>20 - 29 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ---------- &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Unsatisfactory (U)</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    
</body>
  <!-- Jquery JS-->
    <script src="{{URL::to('admin/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{URL::to('admin/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{URL::to('admin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>

    <script type="text/javascript">
        window.print();
    </script>
</html>