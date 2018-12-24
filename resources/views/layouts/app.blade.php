@include('includes.header')

<div id="app">

    {{--SIDE NAVIGATION::BEGIN--}}
        @include('layouts.sidenav')
    {{--SIDE NAVIGATION::END--}}

    <main class="py-4">
        @yield('content')
    </main>
</div>

@include('includes.footer')
