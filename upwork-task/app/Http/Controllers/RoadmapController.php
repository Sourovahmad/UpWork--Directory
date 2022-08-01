<?php

namespace App\Http\Controllers;

use App\Models\roadmap;
use App\Http\Requests\StoreroadmapRequest;
use App\Http\Requests\UpdateroadmapRequest;
use App\Models\phaseItem;
use App\Models\User;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return $users;
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
     * @param  \App\Http\Requests\StoreroadmapRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreroadmapRequest $request)
    {

    
        $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $final = route('home').'/images/'.$imageName;
        
        
                $roadmap = roadmap::create([
                    'title' => $request->title,
                    'image' => $final,
                ]);
                foreach ($request->items as $item) {
                    if(!is_null($item)){
                        phaseItem::create([
                            'roadmap_id' => $roadmap->id,
                             'item' => $item,
                        ]);
                    }
        
                }
                return back()->withSuccess('Roadmap added successfully');   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\roadmap  $roadmap
     * @return \Illuminate\Http\Response
     */
    public function show(roadmap $roadmap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\roadmap  $roadmap
     * @return \Illuminate\Http\Response
     */
    public function edit(roadmap $roadmap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateroadmapRequest  $request
     * @param  \App\Models\roadmap  $roadmap
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateroadmapRequest $request, roadmap $roadmap)
    {

        $roadmap = roadmap::find($request->roadmap_id);

        if(!is_null($request->image)){

            $request->validate(['image' => 'required|mimes:png,jpg,jpeg,gif']);
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $final = route('home') . '/images/' . $imageName;
            $roadmap->image = $final;
        }

        $roadmap->title = $request->title;
        $roadmap->save();

        $prev = $roadmap->items;
        if(!$prev->isEmpty()){
           foreach($prev as $p){
               $p->delete();
           }
        }
        foreach ($request->items as $item) {

            if(!is_null($item)){
                phaseItem::create([
                    'roadmap_id' => $roadmap->id,
                     'item' => $item,
                ]);
            }
         
        }
        return back()->withSuccess('Roadmap updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\roadmap  $roadmap
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'roadmap_id' => 'required'
        ]);
        $roadmap = roadmap::find($request->roadmap_id);
        $prev = $roadmap->items;
        if (!$prev->isEmpty()) {
            foreach ($prev as $p) {
                $p->delete();
            }
        }

        $roadmap->delete();
        return back()->withSuccess('Roadmap Delete successfully');

    }
}
