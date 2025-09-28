<!DOCTYPE html>
<html>
<head>
    <title>Data Kejadian Bencana - Admin</title>
</head>
<body>
    <h1>Data Kejadian Bencana</h1>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Jenis Bencana</th>
            <th>Tanggal</th>
            <th>Lokasi</th>
            <th>Dampak</th>
            <th>Status</th>
        </tr>
        @foreach($kejadian as $k)
        <tr>
            <td>{{ $k['kejadian_id'] }}</td>
            <td>{{ $k['jenis_bencana'] }}</td>
            <td>{{ $k['tanggal'] }}</td>
            <td>{{ $k['lokasi_text'] }}</td>
            <td>{{ $k['dampak'] }}</td>
            <td>{{ $k['status_kejadian'] }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
