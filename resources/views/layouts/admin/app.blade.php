<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    {{-- Include CSS --}}
    @include('layouts.admin.css')
</head>

<body>
    <div class="container-scroller">
        {{-- Header/Navbar --}}
        @include('layouts.admin.header')

        <div class="container-fluid page-body-wrapper">
            {{-- Sidebar --}}
            @include('layouts.admin.sidebar')

            {{-- Theme Settings / Right Sidebar (opsional, kalau kamu pakai) --}}
            @include('layouts.admin.theme-setting')

            <div class="main-panel">
                <div class="content-wrapper">
                    {{-- Konten Halaman --}}
                    @yield('content')
                </div>

                {{-- Footer --}}
                @include('layouts.admin.footer')
            </div>
        </div>
    </div>

    {{-- Include JS --}}
    @include('layouts.admin.js')
</body>

</html>
