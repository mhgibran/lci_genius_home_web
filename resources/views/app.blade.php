<html>
    @include('include.head')

    <body class="skin-3">
    @if(Auth::user()->priv_status == 10 || Auth::user()->priv_status == 11)
                @include('layout.content')
                @else
                @include('layout.header')
                @include('layout.sidebar')
                @include('layout.content')
                @include('include.footer')
                @endif
                @include('include.script')
                
    </body>
</html>