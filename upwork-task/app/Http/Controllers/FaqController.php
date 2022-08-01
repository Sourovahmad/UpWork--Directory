<?php

namespace App\Http\Controllers;

use App\Models\faq;
use App\Http\Requests\StorefaqRequest;
use App\Http\Requests\UpdatefaqRequest;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = faq::orderBy('id', 'DESC')->get();
        return view('admin.faq', compact('faqs'));
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
     * @param  \App\Http\Requests\StorefaqRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorefaqRequest $request)
    {
        faq::create($request->validated());
        return back()->withSuccess('Faq Crated Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatefaqRequest  $request
     * @param  \App\Models\faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'faq_id' => 'required',
            'title' => 'required',
            'ans' => 'required'
        ]);


        $faq = faq::find($request->faq_id);
        $faq->title = $request->title;
        $faq->ans = $request->ans;
        $faq->save();
        return back()->withSuccess('Faq updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'faq_id' => 'required'
        ]);
        faq::findOrFail($request->faq_id)->delete();
        return back()->withSuccess('faq deleted');
    }
}
