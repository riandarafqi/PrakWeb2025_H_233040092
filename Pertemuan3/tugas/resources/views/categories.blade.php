<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Categories</title>
</head>
<body>
    <h1>Halaman Kategori</h1>

    <ul>
        @foreach ($categories as $category)
            <li>
                <h2>{{ $category->name }}</h2>
                <a href="/categories/{{ $category->slug }}">Lihat postingan di kategori ini</a>
            </li>
        @endforeach
    </ul>

</body>
</html>