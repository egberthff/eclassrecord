<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>BISU - eClass Record</title>

		<!-- Meta -->
		<meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
		<meta name="author" content="Bootstrap Gallery" />
		<link rel="canonical" href="https://www.bootstrap.gallery/">
		<meta property="og:url" content="https://www.bootstrap.gallery">
		<meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
		<meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
		<meta property="og:type" content="Website">
		<meta property="og:site_name" content="Bootstrap Gallery">
		<link rel="shortcut icon" href="{{ URL::to('logo.png') }}" />

		<link rel="stylesheet" href="{{ URL::to('assets/fonts/bootstrap/bootstrap-icons.css') }}" />
		<link rel="stylesheet" href="{{ URL::to('assets/css/main.min.css') }}" />
		
		<!-- Scrollbar CSS -->
		<link rel="stylesheet" href="{{ URL::to('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}" />
		
		<!-- Toastify CSS -->
		<link rel="stylesheet" href="{{ URL::to('assets/vendor/toastify/toastify.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{URL::to('package/dist/sweetalert2.min.css')}}">
		<script type="text/javascript" src="{{URL::to('package/dist/sweetalert2.all.min.js')}}"></script>
		<link href="{{URL::to('admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">

		<link rel="stylesheet" href="{{URL::to('datatables/DataTables-1.10.23/css/dataTables.bootstrap4.min.css')}}">
		<link rel="stylesheet" href="{{URL::to('datatables/Responsive-2.2.7/css/responsive.bootstrap4.min.css')}}">
        @yield('head')
		<style>
			.page-wrapper.pinned #logoBig {
				width: 60px !important;
				height: 60px !important;
			}
			.page-wrapper.pinned #logoBigText{
				font-size: 20px !important;
			}

			
		</style>
	</head>

	<body>
		<!-- Page wrapper start -->
		<div class="page-wrapper">

			<!-- Main container start -->
			<div class="main-container">

				<!-- Sidebar wrapper start -->
				<nav id="sidebar" class="sidebar-wrapper">

					<!-- App brand starts -->
					<div class="app-brand px-3 py-2 d-flex align-items-center">
						<a href="/home">
							<img src="{{ URL::to('/logo.png') }}" class="logo" id="logoBig" alt="Bootstrap Gallery" style="width: 100px; height: 100px;max-height: none;" />
							<span style="font-weight: bold;font-size: 30px;" id="logoBigText">e-Class</span>
						</a>
					</div>
					<!-- App brand ends -->

					<!-- Sidebar menu starts -->
					<div class="sidebarMenuScroll">
						<ul class="sidebar-menu">
							@if(Auth::user()->role_id == 0)
							<li class="@yield('college_view')">
								<a href="{{route('view_list')}}">
									<i class="bi bi-table"></i>
									<span class="menu-text">Curriculum</span>
								</a>
							</li>
							<li class="@yield('subject')">
								<a href="{{route('subject.index')}}">
									<i class="bi bi-list"></i>
									<span class="menu-text">Subjects</span>
								</a>
							</li>
							<li class="@yield('faculty')">
								<a href="{{route('faculty.index')}}">
									<i class="bi bi-people"></i>
									<span class="menu-text">Faculties</span>
								</a>
							</li>
							<li class="@yield('students')">
								<a href="{{route('students.index')}}">
									<i class="bi bi-people"></i>
									<span class="menu-text">Students</span>
								</a>
							</li>
							<li class="treeview  @yield('schoolyear') @yield('college') @yield('course') @yield('settings')">
								<a href="#!">
									<i class="bi bi-stickies"></i>
									<span class="menu-text">Maintenance</span>
								</a>
								<ul class="treeview-menu">
									<li>
										<a href="{{route('schoolyear.index')}}">
											<i class="bi bi-ui-radios"></i>
											<span class="menu-text">School Year</span>
										</a>
									</li>
									<li>
										<a href="{{route('college.index')}}">
											<i class="bi bi-table"></i>
											<span class="menu-text">Colleges</span>
										</a>
									</li>
									<li>
										<a href="{{route('course.index')}}">
											<i class="bi bi-book"></i>
											<span class="menu-text">Courses</span>
										</a>
									</li>
									<li>
										<a href="{{route('settings.index')}}">
											<i class="bi bi-gear"></i>
											<span class="menu-text">Grading Percentage</span>
										</a>
									</li>
								</ul>
							</li>

							@endif
							@if(Auth::user()->role_id == 2)
							<li class="treeview  @yield('quizzes') @yield('activities') @yield('attendance') @yield('assignments')">
								<a href="#!">
									<i class="bi bi-stickies"></i>
									<span class="menu-text">Classwork</span>
								</a>
								<ul class="treeview-menu">
									<li>
										<a href="{{route('quizzes.index')}}">
											<i class="bi bi-book"></i>
											<span class="menu-text">Quizzes</span>
										</a>
									</li>
									<li>
										<a href="{{route('activity.index')}}">
											<i class="bi bi-book"></i>
											<span class="menu-text">Activities</span>
										</a>
									</li>
									<li>
										<a href="{{route('attendance.index')}}">
											<i class="bi bi-book"></i>
											<span class="menu-text">Attendance</span>
										</a>
									</li>
									<li>
										<a href="{{route('assignment.index')}}">
											<i class="bi bi-book"></i>
											<span class="menu-text">Assignments</span>
										</a>
									</li>
								</ul>
							</li>
							
							<li class="@yield('projects')">
								<a href="{{route('project.index')}}">
									<i class="bi bi-book"></i>
									<span class="menu-text">Projects</span>
								</a>
							</li>
							<li class="@yield('major_exam')">
								<a href="{{route('major_exam.index')}}">
									<i class="bi bi-book"></i>
									<span class="menu-text">Major Exam</span>
								</a>
							</li>
							<li class="@yield('grades')">
								<a href="{{route('grades')}}">
									<i class="bi bi-ui-checks-grid"></i>
									<span class="menu-text">Grades</span>
								</a>
							</li>
							<li class="@yield('class_record')">
								<a href="{{route('classrecord')}}">
									<i class="bi bi-border-all"></i>
									<span class="menu-text">View Class Record</span>
								</a>
							</li>
							<li class="@yield('create_email')">
								<a href="{{route('create_email')}}">
									<i class="bi bi-mailbox"></i>
									<span class="menu-text">Send Email</span>
								</a>
							</li>
							<li class="@yield('termsettings')">
								<a href="{{route('termsettings')}}">
									<i class="bi bi-wrench"></i>
									<span class="menu-text">Grading Terms</span>
								</a>
							</li>
							@endif
							@if(Auth::user()->role_id == 1)
							<li class="@yield('student_grades')">
								<a href="{{route('student_grades')}}">
									<i class="bi bi-ui-checks-grid"></i>
									<span class="menu-text">Grades</span>
								</a>
							</li>
							@endif
						</ul>
					</div>
					<!-- Sidebar menu ends -->

				</nav>
				<!-- Sidebar wrapper end -->

				<!-- App container starts -->
				<div class="app-container">

					<!-- App header starts -->
					<div class="app-header d-flex align-items-center">

						<!-- Toggle buttons start -->
						<div class="d-flex">
							<button class="btn btn-outline-primary me-2 toggle-sidebar" id="toggle-sidebar">
								<i class="bi bi-text-indent-left fs-5"></i>
							</button>
							<button class="btn btn-outline-primary me-2 pin-sidebar" id="pin-sidebar">
								<i class="bi bi-text-indent-left fs-5"></i>
							</button>
						</div>
						<!-- Toggle buttons end -->

						<!-- App brand sm start -->
						<div class="app-brand-sm d-md-none d-sm-block">
							<a href="index.html">
								<img src="{{ URL::to('assets/images/logo-sm.svg') }}" class="logo" alt="Bootstrap Gallery">
							</a>
						</div>
						<!-- App brand sm end -->

						<!-- App header actions start -->
						<div class="header-actions">
							<div class="dropdown ms-2">
								<a id="userSettings" class="dropdown-toggle d-flex py-2 align-items-center text-decoration-none"
									href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding-right: 10px;">
									<i class="bi bi-person fs-4 me-2"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end shadow-sm">
									<div class="p-3 border-bottom mb-2">
										<h6 class="mb-1">{{Auth::user()->name}}</h6>
										@if(Auth::user()->role_id == 0)
											<p class="m-0 small opacity-50">Administrator</p>
										@elseif(Auth::user()->role_id == 1)
											<p class="m-0 small opacity-50">Parent</p>
										@else
											<p class="m-0 small opacity-50">Faculty</p>
										@endif
										
									</div>
									<a class="dropdown-item d-flex align-items-center" href="{{route('myaccount')}}"><i
											class="bi bi-person fs-4 me-2"></i>Account</a>
									<a class="dropdown-item d-flex align-items-center" href="#" onclick="event.preventDefault(); $('#logout-form').submit();"><i
									class="bi bi-power fs-4 me-2"></i>Logout</a>
									<form id="logout-form" action="{{ route('logout')}}" method="POST" style="display: none;">
										@csrf
									</form>
								</div>
							</div>
						</div>
						<!-- App header actions end -->

					</div>
					<!-- App header ends -->

					<!-- App body starts -->
					<div class="app-body">

						@yield('content')

					</div>
					<!-- App body ends -->

					<!-- App footer start -->
					<!-- <div class="app-footer">
						<span>© Bootstrap Gallery 2023</span>
					</div> -->
					<!-- App footer end -->

				</div>
				<!-- App container ends -->

			</div>
			<!-- Main container end -->

		</div>
		<!-- Page wrapper end -->

		<!-- *************
			************ JavaScript Files *************
		************* -->
		<!-- Required jQuery first, then Bootstrap Bundle JS -->
		<script src="{{ URL::to('assets/js/jquery.min.js') }}"></script>
		<script src="{{ URL::to('assets/js/bootstrap.bundle.min.js') }}"></script>

		<!-- *************
			************ Vendor Js Files *************
		************* -->

		<!-- Overlay Scroll JS -->
		<script src="{{ URL::to('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
		<script src="{{ URL::to('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

		<!-- Toastify JS -->
		<script src="{{ URL::to('assets/vendor/toastify/toastify.js') }}"></script>
		<script src="{{ URL::to('assets/vendor/toastify/custom.js') }}"></script>

		<!-- Apex Charts -->
		<!-- <script src="{{ URL::to('assets/vendor/apex/apexcharts.min.js') }}"></script>
		<script src="{{ URL::to('assets/vendor/apex/custom/home/overview.js') }}"></script>
		<script src="{{ URL::to('assets/vendor/apex/custom/home/reachedAudience.js') }}"></script>
		<script src="{{ URL::to('assets/vendor/apex/custom/home/social.js') }}"></script>
		<script src="{{ URL::to('assets/vendor/apex/custom/home/sparkline.js') }}"></script>
		<script src="{{ URL::to('assets/vendor/apex/custom/home/sparkline2.js') }}"></script>
		<script src="{{ URL::to('assets/vendor/apex/custom/home/visitors.js') }}"></script> -->
		<script src="{{URL::to('admin/vendor/select2/select2.min.js')}}"></script>

		<!-- Custom JS files -->
		<script src="{{ URL::to('assets/js/custom.js') }}"></script>
        <script src="{{URL::to('form-validator/jquery.form-validator.min.js')}}"></script>
		<script type="text/javascript" src="{{URL::to('datatables/DataTables-1.10.23/js/jquery.dataTables.min.js')}}"></script>
		<script type="text/javascript" src="{{URL::to('datatables/DataTables-1.10.23/js/dataTables.bootstrap4.min.js')}}"></script>
		<script type="text/javascript" src="{{URL::to('datatables/Responsive-2.2.7/js/dataTables.responsive.min.js')}}"></script>
		<script type="text/javascript" src="{{URL::to('datatables/Responsive-2.2.7/js/responsive.bootstrap4.min.js')}}"></script>
		<!-- Main JS-->
		<!-- <script src="{{URL::to('admin/js/main.js')}}"></script> -->
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