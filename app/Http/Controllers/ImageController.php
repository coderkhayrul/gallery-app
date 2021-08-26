<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function album()
    {
        $albums = Album::with('images')->orderBy('id', 'DESC')->get();
        return view('welcome', compact('albums'));
    }

    public function index()
    {
        $images = Image::get();
        return view('home', compact('images'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'album' => 'required|min:3|max:50',
            'image' => 'required',
        ]);

        $album = Album::create([
            'name' => $request->get('album')
        ]);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $path = $image->store('uploads', 'public');
                Image::create([
                    'name' => $path,
                    'album_id' => $album->id,
                ]);
            }
        }
        return  '<div class="alert alert-success">Album Created Successfully!</div>';
    }

    public function show($id)
    {
        $album = Album::findOrFail($id);
        return view('gallery', compact('album'));
    }

    public function destory($id)
    {
        $image = Image::findOrFail($id);
        if ($image) {
            unlink('storage/' . $image->name);
        }
        $image->delete();

        return back()->with('success', 'Image Delete Successfully');
    }
}
