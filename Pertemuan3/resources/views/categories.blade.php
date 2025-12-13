<x-layout>
    <x-slot:title>
        Categories
    </x-slot:title>

    <h1 class="text-2xl font-bold mb-4">Daftar Kategori</h1>

    <ul class="list-disc pl-5">
        @foreach ($categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>
</x-layout>
