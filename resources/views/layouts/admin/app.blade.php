<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    {{-- Include CSS --}}
    @include('layouts.admin.css')
</head>
<!-- Floating WhatsApp Button -->
<a href="https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20bertanya" class="floating-whatsapp"
    target="_blank">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<style>
    .floating-whatsapp {
        position: fixed;
        bottom: 25px;
        right: 25px;
        background-color: #25D366;
        color: white;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        text-align: center;
        line-height: 60px;
        font-size: 30px;
        z-index: 1000;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
    }

    .floating-whatsapp:hover {
        background-color: #20b358;
    }

    /* .theme-setting-wrapper {
            position: fixed;
            bottom: 300px;
            right: 25px;
            z-index: 1001;
        } */
</style>

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
