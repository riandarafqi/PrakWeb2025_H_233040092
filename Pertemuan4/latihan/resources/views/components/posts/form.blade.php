@props(['categories'])

@error('nama_field') border-red-500 @enderror
@error('nama_field') @else border-default-medium @enderror

{{-- Form Body --}}
<form action="{{ route('dashboard.store') }}" method="POST" encype=”multipart/formdata”>
    @csrf
    <div class="grid gap-4 grid-cols-2">
        
        {{-- Title --}}
        <div class="col-span-2">
            <label for="title" class="block mb-2.5 text-sm font-medium text-gray-900">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5 shadow-sm placeholder:text-gray-400" 
                    placeholder="Enter post title">
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Category --}}
        <div class="col-span-2">
            <label for="category_id" class="block mb-2.5 text-sm font-medium text-gray-900">Category</label>
            <select name="category_id" id="category_id" 
                    class="block w-full px-3 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm placeholder:text-gray-400">
                <option value="">Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Excerpt --}}
        <div class="col-span-2">
            <label for="excerpt" class="block mb-2.5 text-sm font-medium text-gray-900">Excerpt</label>
            <textarea name="excerpt" id="excerpt" rows="3" 
                        class="block bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-3.5 shadow-sm placeholder:text-gray-400" 
                        placeholder="Write a short excerpt or summary">{{ old('excerpt') }}</textarea>
        </div>

        {{-- Body --}}
        <div class="col-span-2">
            <label for="body" class="block mb-2.5 text-sm font-medium text-gray-900">Content</label>
            <textarea name="body" id="body" rows="8" 
                        class="block bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-3.5 shadow-sm placeholder:text-gray-400" 
                        placeholder="Write your post content here">{{ old('body') }}</textarea>
        </div>

        {{-- Image Upload --}}
        <div class="col-span-2">
            <label for="image" class="block mb-2.5 text-sm font-medium text-gray-900">Upload Image</label>
            <input type="file" name="image" id="image" accept="image/png, image/jpeg, image/jpg"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
            @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Form Footer --}}
        <div class="col-span-2 flex items-center space-x-4 border-t border-gray-200 pt-4 mt-4">
            <button type="submit" 
                    class="inline-flex items-center text-white bg-blue-600 hover:bg-blue-700 border border-transparent focus:ring-4 focus:ring-blue-300 shadow-sm font-medium rounded-lg text-sm px-4 py-2.5 focus:outline-none transition-colors">
                Create Post
            </button>
            <a href="{{ route('dashboard.index') }}" 
                class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 shadow-sm font-medium rounded-lg text-sm px-4 py-2.5 focus:outline-none transition-colors">
                Cancel
            </a>
        </div>
    </div>
</form>