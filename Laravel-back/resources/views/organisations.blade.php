<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        table,
        td {
            margin: 0 auto;
            max-width: 1300px;
            border: 1px solid rgb(43, 42, 42);
        }
        thead {
            background-color: rgb(107, 17, 17);
            color: #fff;
        }
    </style>
</head>

<body>
    <table>
        <h1>Table Organisations</h1>
        <thead>
            <tr>
                <th> Id </th>
                <th>Slug</th>
                <th>Name</th>
                <th>Email</th>
                <th>Tel</th>
                <th>Adress</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($organisations as $organisation)
            <tr>
                <td>{{$organisation->id}}</td>
                <td>{{$organisation->slug}}</td>
                <td>{{$organisation->name}}</td>
                <td>{{$organisation->email}}</td>
                <td>{{$organisation->tel}}</td>
                <td>{{$organisation->adress}}</td>
                <td>{{$organisation->type}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
</body>

</html>
