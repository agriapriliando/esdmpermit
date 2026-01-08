<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        color: #000;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 8px 12px;
        vertical-align: top;
    }

    th {
        width: 30%;
        background-color: #f2f2f2;
        text-align: left;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    @media print {
        body {
            font-size: 11px;
        }
    }
</style>

<body>
    {{ $slot }}
</body>

</html>
