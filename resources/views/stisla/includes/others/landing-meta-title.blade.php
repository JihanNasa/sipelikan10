@php
$_meta_title = $_meta_title ?? config('app.name');
$_meta_description = $_meta_description ?? '';
$_meta_keywords = $_meta_keywords ?? '';
$_meta_author = $_meta_author ?? '';
$_app_name = $_app_name ?? config('app.name');
$_favicon = $_favicon ?? null;
@endphp

<meta charset="UTF-8">
<meta name="description" content="{{ $_meta_description }}">
<meta name="keywords" content="{{ $_meta_keywords }}">
<meta name="author" content="{{ $_meta_author }}">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>{{ $_meta_title }} &mdash; {{ $_app_name }}</title>
<link rel="shortcut icon" href="{{ $_favicon ?? asset('favicon.ico') }}" type="image/x-icon">
