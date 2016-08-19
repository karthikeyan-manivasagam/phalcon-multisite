<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
         <meta http-equiv="x-ua-compatible" content="ie=edge">
          {{ get_title() }}
          {{ stylesheet_link(constant('SITENAME') ~ '/css/style.css') }}
    </head>
    <body>
        {{ content() }}
        {{ javascript_include('https://code.jquery.com/jquery-1.12.0.min.js') }}  
        {{ javascript_include(constant('SITENAME') ~'/js/script.js') }}
        {{ partial('components/common/googleanalytics',['gacode':'UA-XXXXX-X']) }}
    </body>
</html>