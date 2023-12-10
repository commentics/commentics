@if recaptcha_api
    <script src="{{ recaptcha_api }}" async defer></script>
@endif

@if highlight
    <script src="{{ highlight }}" defer></script>
@endif

<script src="{{ common }}" defer></script>

@foreach autoload_javascript as autoload
    <script src="{{ autoload }}" defer></script>
@endforeach

<link rel="stylesheet" type="text/css" href="{{ stylesheet }}">

@foreach autoload_stylesheet as autoload
    <link rel="stylesheet" type="text/css" href="{{ autoload }}">
@endforeach

@if custom
    <link rel="stylesheet" type="text/css" href="{{ custom }}">
@endif

@if site_css
  <link rel="stylesheet" type="text/css" href="{{ site_css }}">
@endif