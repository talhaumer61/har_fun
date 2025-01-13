<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">


<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Admin Dashboard </title>
    <meta name="Description" content="Blazorstrap Responsive Admin Web Dashboard Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
	<meta name="keywords" content="blazor, dashboard admin, blazor c#, admin dashboard template, admin, blazor net, admin panel, blazor template, dashboard, blazorstrap admin template, html dashboard template, net blazor, css and html, html admin template, admin theme, template dashboard, admin dashboard">

    <!-- Favicon -->
    <link rel="icon" href="https://spruko.com/demo/synto/blazor/dist/assets/img/brand-logos/favicon.ico" type="image/x-icon">

    <!-- Choices JS -->
    <script src="{{asset('admin/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>

    <!-- Main Theme Js -->
    <script src="{{asset('admin/js/main.js')}}"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{asset('admin/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" >

    <!-- Style Css -->
    <link href="{{asset('admin/css/styles.min.css')}}" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="{{asset('admin/css/icons.css')}}" rel="stylesheet" >

    <!-- Node Waves Css -->
    <link href="{{asset('admin/libs/node-waves/waves.min.css')}}" rel="stylesheet" >

    <!-- Simplebar Css -->
    <link href="{{asset('admin/libs/simplebar/simplebar.min.css')}}" rel="stylesheet" >

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{asset('admin/libs/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/libs/%40simonwep/pickr/themes/nano.min.css')}}">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{asset('admin/libs/choices.js/public/assets/styles/choices.min.css')}}">


<link rel="stylesheet" href="{{asset('admin/libs/swiper/swiper-bundle.min.css')}}">

</head>

<body>

@include('admin.components.switcher')