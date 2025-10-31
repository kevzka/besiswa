<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('products.search') }}" method="GET">
        <input type="text" name="search" placeholder="Search Products">
        <button type="submit">Search</button>
        @if (count($results ?? []) > 0)
        <ul>
            @foreach ($results as $result)
            <li>{{ $result }}</li>
            @endforeach
        </ul>
        @else
        <p>No results found.</p>
        @endif
    </form>
</body>

</html>