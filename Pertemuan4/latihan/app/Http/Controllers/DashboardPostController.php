<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menggunakan user_id dari user yang sedang login
        $posts = Post::where('user_id', Auth::id())->get();

        // fitur search
        if (request('search')) 
        {
            $posts->where('title', 'like', '%' . request('search') . '%');
        }

        // menampilkan 5 data per halaman dengan pagination
        return view('dashboard.index', ['posts' => $posts->paginate(5)->witQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua categories
        $categories = Category::All();

        return view('dashboard.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Generate slug dari title
        $slug  = Str::slug($request->title);

        // Pastikan slug unique - jika sudah ada, tambahkan angka di belakang
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exist()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Hadle file upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Store file di storage/app/public/post-images
            // Method store() akan generate nama file untuk otomatid
            $imagePath = $request->file('image')->store('post-images', 'public');
        }

        // Create post
        Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'image' => $imagePath, // Simpan path gambar (contoh: post-images/abc123.jpg)
            'user_id' => Auth::id(),
        ]);

        // Validasi input dengan custom messages
        $validator = Validator::make($request->all(), [
            'title'       => 'required|max:255',
            'category_id' => 'required|exists:categories,id', // Memastikan ID ada di tabel categories
            'excerpt'     => 'required',
            'body'        => 'required',
            // Aturan untuk Image: Opsional (nullable), harus gambar, format tertentu, max 2MB
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            // Custom Messages
            'title.required'       => 'Field Title wajib diisi',
            'title.max'            => 'Field Title tidak boleh lebih dari 255 karakter',
            'category_id.required' => 'Field Category wajib dipilih',
            'category_id.exists'   => 'Category yang dipilih tidak valid',
            'excerpt.required'     => 'Field Excerpt wajib diisi',
            'body.required'        => 'Field Content wajib diisi',
            'image.image'          => 'File harus berupa gambar',
            'image.mimes'          => 'Format gambar harus jpeg, png, jpg, atau gif',
            'image.max'            => 'Ukuran gambar maksimal 2MB',
        ]);

        // Jika validasi gagal, redirect kembali dengan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) // Mengirimkan semua pesan error kembali
                ->withInput();
        }

        return redirect()->route('dashboard.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => \App\Models\Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // 1. Validasi
        $rules = [
            'title'       => 'required|max:255',
            'category_id' => 'required',
            'image'       => 'image|file|max:2048', // Validasi gambar (maks 2MB)
            'body'        => 'required'
        ];

        // Validasi Slug: Unik, tapi kecualikan slug milik postingan ini sendiri
        if($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        // 2. Handle Upload Gambar Baru (Jika ada)
        if($request->file('image')) {
            // Hapus gambar lama jika ada
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            // Simpan gambar baru
            $validatedData['image'] = $request->file('image')->store('post-images', 'public');// [cite: 2254]
        }

        // 3. Update Excerpt dan User ID
        $validatedData['user_id'] = Auth::id();
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        // 4. Proses Update
        Post::where('id', $post->id)
            ->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // 1. Cek apakah ada gambar? Jika ada, hapus file fisiknya
        if($post->image) {
            Storage::delete($post->image);// [cite: 2222] (Konsep Storage di modul)
        }

        // 2. Hapus data dari database
        Post::destroy($post->id); // Atau $post->delete();

        // 3. Redirect kembali
        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }
}