<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <base href="./">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="author" content="rocsel.com">
        <meta name="description" content="<?= settings("description", "ar") ?>">
        <meta name="keyword" content="<?= settings("keywords", "ar") ?>">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="url-base" content="{{ RC_url() }}">
        <meta name="url-current" content="{{ url()->full()}}">
        <title><?= settings("title", "ar") ?></title>
        <?= view(RC_urlView("layout/css")) ?>
        <meta name="robots" content="noindex">
    </head>