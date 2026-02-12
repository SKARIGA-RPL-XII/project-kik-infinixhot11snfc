<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>UsahaKita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap (opsional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-5 bg-white p-4 shadow rounded">

        {{-- INI PENTING --}}
        @yield('content')

    </div>
</div>

</body>
</html>
