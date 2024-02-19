<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Feed;
class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feed = Feed::paginate(2);
        return view('feed.index', compact('feed'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feed.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video' => ['required', 'file', 'mimetypes:video/mp4,video/mpeg,video/quicktime', 'max:10240'],
            'caption' => ['nullable', 'string', 'max:100'],
        ]);

        $user = auth()->user();
        $feed = new Feed();
        $feed->created_by = $user->id;
        $feed->video = $request->file('video')->store('feed');
        $feed->caption = $request->caption;
        $feed->save();

        return redirect()->route('feed.index')->with('succes', 'Feed Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feed $feed)
    {
        // Hapus video dari penyimpanan sebelum menghapus data dari database

        if ($feed->video) {

            Storage::delete($feed->video);

        }

        if ($feed->delete()) {
            return redirect()->route('feed.index')->with('success', 'feed berhasil dihapus!');

        }
        return redirect()->route('feed.index')->with('error', 'Gagal menghapus feed.');

    }

}
    

