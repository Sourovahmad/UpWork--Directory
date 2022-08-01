<?php

namespace App\Http\Controllers;

use App\Models\todo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\faq;
use App\Models\roadmap;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = todo::orderBy('id', 'DESC')->paginate(10);
        return view('admin.todo', compact('todos'));
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
    public function store(StoreTodoRequest $request)
    {
      
        $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $final = route('home').'/images/'.$imageName;
        
        
                $todo = todo::create([
                    'title' => $request->title,
                    'desc'=>$request->desc,
                    'image' => $final,
                ]);
          
                return back()->withSuccess('todo added successfully');   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, todo $todo)
    {
        $todo = todo::find($request->todo_id);

      

        if(!is_null($request->image)){

            $request->validate(['image' => 'required|mimes:png,jpg,jpeg,gif']);
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $final = route('home') . '/images/' . $imageName;
            $todo->image = $final;
        }

        $todo->title = $request->title;
        $todo->desc = $request->desc;

        $todo->save();
        return back()->withSuccess('Todo updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'todo_id' => 'required'
        ]);
        todo::findOrFail($request->todo_id)->delete();
        return back()->withSuccess('todo deleted');
    }
}
