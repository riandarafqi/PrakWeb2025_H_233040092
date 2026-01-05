{{-- Header with Search and Add Post Button --}}
<div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center gap-4 bg-gradient-to-r from-blue-50 to-indigo-50">
    <form method="GET" action="{{ route('dashboard.index') }}" class="flex-1 max-w-md">
        <label for="search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" name="search" id="search" value="{{ request('search') }}" class="block w-full p-3 ps-9 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" placeholder="Search posts..." />
            <button type="submit" class="absolute end-1.5 bottom-1.5 text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 focus:outline-none">Search</button>
        </div>
    </form>

    <a href="{{ route('dashboard.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-200 whitespace-nowrap">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add Post
    </a>
</div>

{{-- Table --}}
<div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
    <table class="w-full text-sm text-left rtl:text-right text-body">
        
        {{-- BAGIAN HEADER TABEL (JUDUL KOLOM) --}}
        <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
            <tr>
                <th scope="col" class="px-6 py-3 font-medium">No</th>
                <th scope="col" class="px-6 py-3 font-medium">Title</th>
                <th scope="col" class="px-6 py-3 font-medium">Category</th>
                <th scope="col" class="px-6 py-3 font-medium">Date</th>
                <th scope="col" class="px-6 py-3 font-medium">Action</th>
            </tr>
        </thead>

        {{-- BODY TABEL --}}
        <tbody>
            @forelse ($posts as $post)
            <tr class="bg-neutral-primary border-b border-default hover:bg-gray-50">
                
                {{-- Nomor --}}
                <td class="px-6 py-4">
                    {{ $loop->iteration + $posts->firstItem() - 1 }}
                </td>

                {{-- Judul Post --}}
                <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                    {{ $post->title }}
                </th>

                {{-- Kategori --}}
                <td class="px-6 py-4">
                    {{ $post->category->name }}
                </td>

                {{-- Tanggal --}}
                <td class="px-6 py-4">
                    {{ $post->created_at->format('d M Y') }}
                </td>

                <td class="px-6 py-4 flex gap-2">
                    {{-- Tombol View --}}
                    <a href="{{ route('dashboard.posts.show', $post->slug) }}" class="font-medium text-blue-600 hover:underline">View</a>
                    
                    {{-- Tombol Edit --}}
                    <a href="{{ route('dashboard.posts.edit', $post->slug) }}" class="font-medium text-yellow-600 hover:underline">Edit</a>

                    {{-- FORM DELETE --}}
                    <form action="{{ route('dashboard.posts.destroy', $post->slug) }}" method="POST" class="inline-block">
                        @method('delete')
                        @csrf
                        <button class="font-medium text-red-600 hover:underline border-0 bg-transparent cursor-pointer" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                    No posts found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- FLOWBITE PAGINATION --}}
    @if($posts->hasPages())
    <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4 px-4 pb-4" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 mb-4 md:mb-0 block w-full md:inline md:w-auto">
            Showing <span class="font-semibold text-gray-900">{{ $posts->firstItem() }}-{{ $posts->lastItem() }}</span> of <span class="font-semibold text-gray-900">{{ $posts->total() }}</span>
        </span>
        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
            <li>
                @if($posts->onFirstPage())
                    <span class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-400 bg-white border border-gray-300 rounded-s-lg cursor-not-allowed">Previous</span>
                @else
                    <a href="{{ $posts->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">Previous</a>
                @endif
            </li>
            @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                <li>
                    @if ($page == $posts->currentPage())
                        <span aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">{{ $page }}</a>
                    @endif
                </li>
            @endforeach
            <li>
                @if($posts->hasMorePages())
                    <a href="{{ $posts->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">Next</a>
                @else
                    <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-400 bg-white border border-gray-300 rounded-e-lg cursor-not-allowed">Next</span>
                @endif
            </li>
        </ul>
    </nav>
    @endif
</div>