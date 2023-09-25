<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $setting->nama_website }}</title>

    <link href="{{ url($setting->favicon) }}" rel="icon">
    
    {{-- CSS --}}
    @yield('css')

    @yield('script_css')

  </head>
  <body>
    {{-- Navbar --}}
    @include('layouts.partials.navbar')

    {{-- Content --}}
    @yield('content')

    {{-- JS --}}
    @yield('js')

    @yield('script')
    
  </body>
</html>