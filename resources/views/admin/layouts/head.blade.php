<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
		<meta content="Themesbrand" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- App favicon -->
		<link rel="shortcut icon" href="{{asset('dashboard/images/weDo.png')}}">

		@stack('page_style')
        
		<!-- Bootstrap Css -->
        <link href="{{asset('dashboard/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('dashboard/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('dashboard/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <!-- Sweet Alert-->
        <link href="{{asset('dashboard/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/1.3.1/css/toastr.css">

        <style type="text/css">
            .simplebar-offset{
                /*overflow: scroll;*/
            }
        	form .card{
        		margin: 20px 10%;
        	}
            .navbar-brand-box{
                background-color: #1b82ec !important
            }
            .hidden{
                display: none;
            }
            #sidebar-menu ul li a{
                padding: 13px 20px;
            }
            .bulk-actions-buttons{
                text-align: center;
            }
            .user-name{
                color: white;
            }
        </style>

        @stack('css')
    </head>

    <body data-topbar="colored">

	<!-- <body data-layout="horizontal" data-topbar="colored"> -->
