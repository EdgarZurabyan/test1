<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        $recentLinks = Link::latest()->take(10)->get();
        return view('index', compact('recentLinks'));
    }

    public function shorten(Request $request)
    {
        $originalLink = $request->input('link');
        $shortenedLink = $this->generateShortenedLink();
        Link::create([
            'original_link' => $originalLink,
            'shortened_link' => $shortenedLink,
        ]);

        return response()->json([
            'shortenedLink' => $shortenedLink,
        ]);
    }

    public function recentLinks()
    {
        $recentLinks = Link::latest()->take(10)->get();
        return response()->json([
            'recentLinks' => $recentLinks,
        ]);
    }

    private function generateShortenedLink()
    {
        $lastLink = Link::latest()->first();
        if ($lastLink) {
            $lastShortenedLink = $lastLink->shortened_link;
            $nextShortenedLink = ++$lastShortenedLink;
        } else {
            $nextShortenedLink = 'a';
        }

        return 'site.ru/' . $nextShortenedLink;
    }
}
