@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm p-4">
        <div class="text-center mb-4">
            <img src="{{ asset('assets-admin/images/pengembang.jpg') }}"
                 class="rounded-circle mb-3"
                 width="140" height="140" style="object-fit: cover;">

            <h3 class="mb-0">Nofita Nurchasanah</h3>
            <p class="text-muted">2457301114 • Sistem Informasi • Politeknik Caltex Riau</p>
        </div>
        <hr>
        <h5 class="mt-4">Tentang Saya</h5>
        <p>
            Mahasiswa Sistem Informasi yang tertarik pada pengembangan aplikasi berbasis web,
            UI/UX, dan sistem informasi manajemen. Senang belajar hal baru dan membangun aplikasi
            yang bermanfaat untuk masyarakat.
        </p>
        <h5 class="mt-4">Kontak & Sosial Media</h5>
        <ul class="list-group mt-3">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Email:</strong>
                <span>nofita24si@mahasiswa.pcr.ac.id</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>LinkedIn:</strong>
                <a href="https://www.linkedin.com/in/nofita-nurchasanah-2b64b0360?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank">linkedin.com/in/nofita</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>GitHub:</strong>
                <a href="https://github.com/nofita18" target="_blank">github.com/nofita</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Instagram:</strong>
                <a href="https://www.instagram.com/panggilnopi_?igsh=" target="_blank">@panggilnopi_</a>
            </li>
        </ul>
        <a href="{{ route('dashboard') }}" class="btn btn-primary mt-4">Kembali ke Dashboard</a>
    </div>
</div>
@endsection
