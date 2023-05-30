<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLinkRequest;
use App\Models\Link;

class LinkController extends Controller
{
    public function index()
    {
        return view('links.index');
    }

    public function store(CreateLinkRequest $request)
    {
        foreach ($request->links as $link) {
            $id = $link['id'] ?? null;

            Link::updateOrCreate([
                'id' => $id,
            ], $link);
        }

        return response()->json([
            'links' => $request->user()->links,
        ], 200);
    }

    public function destroy(Link $link)
    {
        $link->delete();

        return response()->json([
            'links' => auth()->user()->links,
        ], 200);
    }
}
