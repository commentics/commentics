@if jquery
    <script src="{{ jquery }}"></script>
@endif

@if jquery_ui
    <script src="{{ jquery_ui }}" defer></script>
@endif

@if read_more
    <script src="{{ read_more }}" defer></script>
@endif

@if filer
    <script src="{{ filer }}" defer></script>
@endif

@if timeago
    <script src="{{ timeago }}" defer></script>
@endif

@if recaptcha_api
    <script src="{{ recaptcha_api }}" async defer></script>
@endif

@if highlight
    <script src="{{ highlight }}" defer></script>
@endif

<script src="{{ common }}" defer></script>

<link rel="stylesheet" type="text/css" href="{{ stylesheet }}">

@if custom
    <link rel="stylesheet" type="text/css" href="{{ custom }}">
@endif