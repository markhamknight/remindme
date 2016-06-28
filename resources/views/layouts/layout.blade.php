<!DOCTYPE html>
<html>
<head>
    <title>RemindMe</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/bootstrap-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/bootstrap-datepicker.standalone.css') }}">
    <style>
        #bg {
            background-image: url({{ URL::asset('/images/bg.png') }});
            background-size:     cover;
            background-repeat:   no-repeat;
            background-position: fixed;
        }
         body {
            background-image: url({{ URL::asset('/images/bg.png') }});
            background-size:     cover;
            background-repeat:   no-repeat;
            background-position: fixed;
        }
    </style>
</head>
<body>
    
        @yield('navigation')
        
        @yield('content')

        @yield('footer')
  
</body>
<script src="{{ url('/js/jquery.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ url('/js/bootstrap.min.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ url('/js/bootstrap-select.js') }}" type="text/javascript" charset="utf-8" ></script>
<script src="{{ url('/js/bootstrap-datepicker.js') }}" type="text/javascript" charset="utf-8"  defer></script>
<script src="{{ url('/js/validator.js') }}" type="text/javascript" charset="utf-8" ></script>
<script src="{{ url('/js/other.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ url('/js/ajax.js') }}" type="text/javascript" charset="utf-8"></script>

</html>