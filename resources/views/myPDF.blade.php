<!DOCTYPE html>
<html>

<head>
    <title>{{ $business }}</title>
</head>

<body>
    <h1>{{ $business }}</h1>
    <p>Created at: {{ $created_at }}</p>
    <table>
        <tr>
            <td>Owner:</td>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>{{ $email }}</td>
        </tr>
        <tr>
            <td>Phone:</td>
            <td>{{ $phone }}</td>
        </tr>
        <tr>
            <td>Address:</td>
            <td>{{ $address }}</td>
        </tr>
        <tr>
            <td>Category:</td>
            <td>{{ $category }}</td>
        </tr>
        <tr>
            <td>MSME:</td>
            <td>{{ $msme }}</td>
        </tr>
    </table>
</body>

</html>
