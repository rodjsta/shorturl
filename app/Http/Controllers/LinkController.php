<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class LinkController extends Controller
{
    public function index()
    {
        return view('link.index');
    }

    public function store(Request $request)
    {
        $validator = Link::validate($request);

        if ($validator->fails()) {
            return redirect(route('link'))
                ->withErrors($validator)
                ->withInput();
        }

        // create a random lowercase string for a hash
        $hash = Str::lower(Str::random(6));

        $short_url = config('app.url').'/'.$hash;

        try {
            Link::create([
                'url' => $request->url,
                'hash' => $hash,
            ]);
            return redirect(route('link'))->with([
                'success' => 'Your URL has been shortened.',
                'short_url' => $short_url,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function show($hash)
    {
        $link = Link::byHash($hash)->first();

        if (!$link)
            return redirect(route('link'))->withErrors("Link for {$hash} does not exist");

        // update the link visit data
        $link->update([
            'visit_count' => $link->visit_count++,
            'last_accessed' => now(),
        ]);

        return redirect()->away($link->url);
    }
}
