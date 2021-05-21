<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shortLinks = ShortLink::latest()->get();

        //return view('url.shortenLink', compact('shortLinks'));
        return view('url.shortenLink', ['shortLinks' => $shortLinks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
         ]);
 
         $input['link'] = $request->link;
         $input['code'] = uniqid();
         $input['clicks'] = 0;
         
         ShortLink::create($input);

         $shortLinks = ShortLink::latest()->get();
 
        return view('url.shortenLink', ['shortLinks' =>$shortLinks])
            ->with('success', 'Shorten Link Generated Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ShortLink $link)
    {
        return view('url.editLink', ['link' => $link]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShortLink $link)
    {
        $arr = $request->input();
        if ($arr['code']) {
            $link->code = $arr['code'];
        }
        if ($arr['link']) {
            $link->link = $arr['link'];
            $link->clicks = 0;
        }
        $link->save();
        return redirect()->route('links.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShortLink $link)
    {
        $link->delete();
    
        return redirect()->route('links.index');
        //return view('url/shortenLink', compact('shortLinks'));
    }

    public function shortenLink(ShortLink $link)
    {
        $code = $link->code;
        $find = ShortLink::where('code', $code)->first();
        return redirect($find->link);
    }

    public function addClick(ShortLink $link){
        $link->clicks ++;
        $link->save();
        return response()->json($link);
    }
}
