<!DOCTYPE html>
<!--https://coreui.io/demo/3.4.0/-->
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <base href="./">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
        <meta name="author" content="Łukasz Holeczek">
        <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="url-main" content="{{ asset("rc-admin", true) }}">
        <meta name="url-base" content="{{ asset("" , true) }}">
        <meta name="url-current" content="{{ url()->full()}}">


        <title>لوحة التحكم</title>

 

        {{view("admin/layout/css")}}



        <meta name="robots" content="noindex">
    </head>
