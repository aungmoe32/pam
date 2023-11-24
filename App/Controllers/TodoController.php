<?php
namespace App\Controllers;

use App\Models\Todo;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index(){
        return view('pages.home');
    }

    public function create(){
        // return request();
        $todo = new Todo();
        $todo->title = request()->title;
        $todo->checked = 0;
        $todo->user_id = user()->id;

        $todo->save();

        return redirect('/todos');

    }

    public function show(){
        $todos = user()->todos;
        return view('pages.todos', compact('todos'));

    }
    public function edit(){
        $todos = user()->todos;
        return view('pages.edit', compact('todos'));

    }
    public function save(){
        // return request();
        $request = request();
        $arr = array_keys($request->toArray());
        Todo::whereIn('id', $arr)->update(['checked' => 1]);
        Todo::whereNotIn('id', $arr)->update(['checked' => 0]);

        return redirect('/todos');

    }
    public function delete($id){
        $to = Todo::find($id);
        if($to){
            $to->delete();
        }

        return redirect('/todos');


    }
}