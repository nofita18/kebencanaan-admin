    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets-admin/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets-admin/images/favicon.png') }}" />

    <!-- Font Awesome 7 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

    <style>
        /* === Custom warna header tabel === */
        table thead th {
            background-color: #bfc4ef !important;
            /* ungu muda */
            color: #000 !important;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table th,
        table td {
            border: 2px solid #444;
            /* garis lebih tebal dan gelap */
            padding: 8px;
            vertical-align: middle;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border: 2px solid #444;
            /* garis luar tabel */
        }

        /* Warna tombol */
        .btn-warning {
            background-color: #ffc107;
            color: #000;
            border: none;
        }

        .btn-danger {
            background-color: #ff4d4d;
            border: none;
        }
    </style>

    <style>
        .badge-gender {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            /* Biar bulat */
            font-weight: 600;
            font-size: 14px;
            text-align: center;
            min-width: 100px;
        }

        .badge-perempuan {
            background-color: #ffb6c1;
            /* pink muda */
            color: #000;
            /* teks hitam */
        }

        .badge-laki {
            background-color: #add8e6;
            /* biru muda */
            color: #000;
        }
    </style>
