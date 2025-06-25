<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>BISUFacultyEvaluation</title>

    <!-- Fontfaces CSS-->
    <link href="{{URL::to('admin/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::to('admin/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::to('admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::to('admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link href='https://fonts.googleapis.com/css?family=Akshar|Abhaya+Libre|Adamina|Arbutus+Slab|Berkshire+Swash' rel='stylesheet'>

    <!-- Bootstrap CSS-->
    <link href="{{URL::to('admin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{URL::to('admin/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::to('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::to('admin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::to('admin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::to('admin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::to('admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::to('admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="{{URL::to('admin/css/DragAndDropUpload.css')}}">

    <!-- Main CSS-->
    <link href="{{URL::to('admin/css/theme.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="{{URL::to('package/dist/sweetalert2.min.css')}}">
    <script type="text/javascript" src="{{URL::to('package/dist/sweetalert2.all.min.js')}}"></script>

    <link rel="stylesheet" href="{{URL::to('datatables/DataTables-1.10.23/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('datatables/Responsive-2.2.7/css/responsive.bootstrap4.min.css')}}">

    @yield('head')
    <style type="text/css">
        body{
            font-size: 13px;
        }
        .main-content {
            padding-top: 61px;
        }
        .navbar__list li a{
            color: white !important;
        }

        .century_gothic{
            font-family: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol"';
            font-size: 14px;
        }
        .cambria{
            font-family: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol"';
            font-size: 14px;
            color: black;
        }
        .calibri{
            font-family: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol"';
            
        }
        .margin-0rem{
            margin-bottom: 0rem;
        }
        .fsize_15{
            font-size: 14px;
        }
        .checkbox-wrapper-28 label{
            font-family: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol"';
            font-size: 14px;
        }
        
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
            margin-right: 11px;
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
        @media only screen and (max-width: 425px) {
            .col-2 {
                margin-left: 8px;
                padding-bottom: 10px;
            }
        }
        .form-check-input.is-invalid .form-check-label {
            color: red;
        }
        .list-unstyled li a{
            color: white !important;
        }
        div.sidebar-collapse .bisudesc{
            padding-left: 20px !important;
            color: white !important;
            font-size: 18px !important;
        }


        @media (max-width: 1421px) {
            .header-desktop{
                margin-top: -87px;
                margin-left: -16px;
            }

            .bisudesc{
                margin-top: 70px;
                margin-left: -100px !important;
            }

            .js-acc-btn{
                color: #333 !important;
            }

            .main-content{
                padding-top: 80px;
            }
        }
    </style>

    <style>
        .wrapper {
        width: 100%;
        padding-left: 200px;
        transition-duration: 0.5s;
        }
        .wrapper .sidebar {
        width: 200px;
        height: 100%;
        position: absolute;
        left: 0px;
        top: 0px;
        background: #330066;
        white-space: nowrap;
        transition-duration: 0.5s;
        z-index: 1000;
        }
        .wrapper .sidebar .sb-item-list {
        width: 100%;
        height: calc(100% - 50px);
        }
        .wrapper .sidebar .sb-item-list > .sb-item > .sb-text {
        position: absolute;
        transition-duration: 0.5s;
        }
        .wrapper .sidebar .sb-item {
        display: block;
        width: 100%;
        line-height: 50px;
        color: #ccc;
        background: #330066;
        cursor: pointer;
        padding-left: 7px;
        }
        .wrapper .sidebar .sb-item.active {
        border-left: solid 3px green;
        box-sizing: border-box;
        }
        .wrapper .sidebar .sb-item.active > .sb-icon {
        margin-left: -3px;
        }
        .wrapper .sidebar .sb-icon {
        padding-left: 10px;
        padding-right: 20px;
        }
        .wrapper .sidebar .sb-item:hover,
        .wrapper .sidebar .sb-item.active {
        filter: brightness(130%);
        }

        .wrapper .sb-menu {
        position: relative;
        }
        .wrapper .sb-menu:after {
        content: " ";
        width: 0;
        height: 0;
        display: block;
        float: right;
        margin-top: 19px;
        margin-left: -12px;
        margin-right: 5px;
        border: solid 5px transparent;
        border-left-color: #eee;
        }
        .wrapper .sb-menu > .sb-submenu {
        display: none;
        }
        .wrapper .sb-menu:hover > .sb-submenu {
        position: absolute;
        display: block;
        width: 200px;
        top: 0;
        left: calc(100% + 1px);
        }

        .wrapper .sb-submenu > .sb-item:first-child {
        border-radius: 8px 8px 0px 0px;
        }

        .wrapper .sb-submenu > .sb-item:last-child {
        border-radius: 0px 0px 8px 8px;
        }

        .wrapper .btn-toggle-sidebar {
        left: 0;
        bottom: 0;
        border-top: 1px solid #aaa;
        user-select: none;
        }
        .wrapper .btn-toggle-sidebar .sb-icon {
        padding-left: 15px;
        }
        .wrapper .btn-toggle-sidebar .sb-icon.fa-angle-double-left {
        display: inline-block;
        }
        .wrapper .btn-toggle-sidebar .sb-icon.fa-angle-double-right {
        display: none;
        }

        .wrapper.sidebar-collapse {
        padding-left: 60px;
        }
        .wrapper.sidebar-collapse .sidebar {
        width: 60px;
        }
        .wrapper.sidebar-collapse .sb-item-list > .sb-item > .sb-text {
        position: absolute;
        transform: translateX(-200%);
        opacity: 0;
        }

        .wrapper.sidebar-collapse .btn-toggle-sidebar .sb-icon.fa-angle-double-left {
        display: none;
        }
        .wrapper.sidebar-collapse .btn-toggle-sidebar .sb-icon.fa-angle-double-right {
        display: inline-block;
        }
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">        

            <div class="wrapper sidebar-collapse">
                <div class="sidebar">
                    <div class="sb-item-list">
                    <?php
                        $schoolyear = App\Schoolyear::where('status', 1)->first();
                        $settings = App\EvaluationSetting::where('schoolyear_id', $schoolyear->id)->first();
                    ?>
                    
                    <div class="btn-toggle-sidebar sb-item"><img src="{{URL::to('/logo.png')}}" style="width: 129px;padding-left: 0px;" alt="BISU" /></div>
                    @if(Auth::user()->role_id == 0)
                    <div class="sb-item @yield('home')" onclick="window.location.href ='/home'"><i class="sb-icon fa fa-tachometer-alt"></i><span class="sb-text">Dashboard</span></div>
                    <div class="sb-item @yield('schoolyear')" onclick="window.location.href ='{{route('schoolyear.index')}}'"><i class="sb-icon fas fa-chart-bar"></i><span class="sb-text">School Year</span></div>
                    <div class="sb-item @yield('college')" onclick="window.location.href ='{{route('college.index')}}'"><i class="sb-icon fas fa-table"></i><span class="sb-text">Colleges</span></div>
                    <div class="sb-item @yield('course')" onclick="window.location.href ='{{route('course.index')}}'"><i class="sb-icon fas fa-book"></i><span class="sb-text">Courses</span></div>
                    <div class="sb-item @yield('subject')" onclick="window.location.href ='{{route('subject.index')}}'"><i class="sb-icon fas fa-list"></i><span class="sb-text">Subjects</span></div>
                    <div class="sb-item @yield('coursecoor')" onclick="window.location.href ='{{route('coursecoor.index')}}'"><i class="sb-icon fa fa-address-card"></i><span class="sb-text">Coordinatorship</span></div>
                    <div class="sb-item @yield('students')" onclick="window.location.href ='{{route('students.index')}}'"><i class="sb-icon fas fa-users"></i><span class="sb-text">Students</span></div>
                    <div class="sb-item @yield('faculty')" onclick="window.location.href ='{{route('faculty.index')}}'"><i class="sb-icon fas fa-graduation-cap"></i><span class="sb-text">Faculty</span></div>
                    <div class="sb-item @yield('evaluation')" onclick="window.location.href ='{{route('evaluationsettings')}}'"><i class="sb-icon fas fa-cogs"></i><span class="sb-text">Evaluation Settings</span></div>
                    <div class="sb-item @yield('selectfaculty_evaluate')" onclick="window.location.href ='{{route('selectfaculty_evaluate')}}'"><i class="sb-icon fas fa-th-list"></i><span class="sb-text">Evaluate</span></div>
                    <div class="sb-item @yield('selectfaculty_generate')" @if($settings->secondsem_enabled == '1') onclick="window.location.href =' {{route('selectreportsemester')}}'" @else onclick="window.location.href =' {{route('selectfaculty_generatereport', 1)}}'" @endif><i class="sb-icon fas fa-print"></i><span class="sb-text">Reports</span></div>
                    
                    @elseif(Auth::user()->role_id == 1)
                    <div class="sb-item @yield('evaluate')" onclick="window.location.href ='{{route('faculty_evaluate')}}'"><i class="sb-icon fas fa-th-list"></i><span class="sb-text">Evaluate</span></div>
                    @endif
                    
                </div>
            </div>

        <!-- PAGE CONTAINER-->
        <div class="page-container" style="padding-left: 0px">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop" style="background: #330066;left: 0px;height: 53px;">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                           <p class="bisudesc" style="color: white;font-size: 18px;padding-left: 160px">BISU Balilihan Campus</p>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <a class="js-acc-btn" href="#" style="color: white;"><i class="fa fa-user"></i> {{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('myaccount')}}">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                            <a class="dropdown-item" href="{{route('logout')}}"
                                                onclick="event.preventDefault(); $('#logout-form').submit();">
                                                    <i class="zmdi zmdi-power"></i>Logout
                                                </a>

                                                <form id="logout-form" action="{{ route('logout')}}" method="POST" style="display: none;">
                                                @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content" style="background-color: #E9F1FA">
                    @yield('content')
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <!-- Jquery JS-->
    <script src="{{URL::to('admin/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{URL::to('admin/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{URL::to('admin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{URL::to('admin/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{URL::to('admin/vendor/wow/wow.min.js')}}"></script>
    <script src="{{URL::to('admin/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{URL::to('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{URL::to('admin/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{URL::to('admin/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{URL::to('admin/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{URL::to('admin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{URL::to('admin/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{URL::to('admin/vendor/select2/select2.min.js')}}"></script>
    <script src="{{URL::to('form-validator/jquery.form-validator.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('datatables/DataTables-1.10.23/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('datatables/DataTables-1.10.23/js/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('datatables/Responsive-2.2.7/js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('datatables/Responsive-2.2.7/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- Main JS-->
    <script src="{{URL::to('admin/js/main.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table').DataTable( {
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'Details for '+data[0]+' '+data[1];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                }
            } );

            $('#table2').DataTable( {
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'Details for '+data[0]+' '+data[1];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                }
            } );
        } );
        
    </script>
    <script>
        $.validate();
        $(document).ready(function(){
          @if(  Session::has('Account_updated') )
          swal(
                        'Data Saved.',
                        'Account updated successfully.',
                        'success'
                    )
          @endif
      });
    </script>
    <script>
        $(function(){
        // toggle sidebar collapse
        $('.btn-toggle-sidebar').on('click', function(){
            $('.wrapper').toggleClass('sidebar-collapse');
        });
        $('.sb-item-list').on('mouseover', function(){
            $('.wrapper').toggleClass('sidebar-collapse');
        });
        $('.sb-item-list').on('mouseout', function(){
            $('.wrapper').toggleClass('sidebar-collapse');
        });
        // mark sidebar item as active when clicked
        $('.sb-item').on('click', function(){
            if ($(this).hasClass('btn-toggle-sidebar')) {
            return; // already actived
            }
            $(this).siblings().removeClass('active');
            $(this).siblings().find('.sb-item').removeClass('active');
            $(this).addClass('active');
        })
    });
    </script>
    @yield('scripts')

</body>

</html>
<!-- end document-->
