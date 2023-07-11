@include('admin.layouts.head')

	<!-- Begin page -->
    <div id="layout-wrapper">
		@include('admin.layouts.header')
		@include('admin.layouts.left_sidebar')

		<div class="main-content">
			@yield('content')
		</div>
		@include('admin.layouts.footer')
	</div>
	{{-- @include('admin.layouts.right_sidebar') --}}
@include('admin.layouts.scriptis')