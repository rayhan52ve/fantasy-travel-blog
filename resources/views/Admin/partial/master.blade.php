<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>Acorn Admin Template</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon Tags Start -->
    @include('admin.partial._layout.css')
  </head>

  <body>
    <div id="root">
        @include('admin.partial._layout.sidebar')
     
 @yield('contant')

      @include('admin.partial._layout.footer')
      <!-- Layout Footer End -->
    </div>

    @include('admin.partial._layout.theme')

    @include('admin.partial._layout.searchbar')

    @include('admin.partial._layout.js')
    @yield('js')

    <!-- Page Specific Scripts End -->
  </body>
</html>
