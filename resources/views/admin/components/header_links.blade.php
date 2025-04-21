<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">


<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> {{$title}} - HARFUN </title>
    <meta name="Description" content="">
	<meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{asset('site/images/fav-icon/icon.png')}}" type="image/x-icon">

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
    
    <link rel="stylesheet" href="{{asset('admin/libs/swiper/swiper-bundle.min.css')}}">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{asset('admin/libs/choices.js/public/assets/styles/choices.min.css')}}">

    <!-- Prism CSS -->
    <link rel="stylesheet" href="{{asset('admin/libs/prismjs/themes/prism-coy.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('admin/libs/filepond/filepond.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/libs/dropzone/dropzone.css')}}">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <style>
        .cke_notification{
            display: none !important;
        }
    </style>
</head>

<body>

{{-- @include('admin.components.switcher') --}}