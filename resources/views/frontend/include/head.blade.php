@php
    $setting = App\Models\Setting::query()->select('favicon')->first();
@endphp
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<link rel="icon" href="{{ URL::asset(asset($setting->favicon)) }}" type="image/x-icon" />

<link rel="stylesheet" href="{{ asset('backend/bootstrap-5.3.3/dist/css/bootstrap.min.css') }}">
@yield('css')
