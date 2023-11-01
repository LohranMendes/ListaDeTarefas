<!DOCTYPE html>
<html>
    <head>       
        @include('layout.head')
        <title>@yield("title")</title>
    </head>

    <body>
        @include('layout/header')

        @yield("content")

        @include('layout.footer')
        
    </body>
</html>