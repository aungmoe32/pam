@extends('app')
@section('content')
    <div class="flex flex-col h-full w-full">

        <div class="flex justify-between m-4 items-center ">
            <div class="font-semibold text-xl text-gray-800">
                
            </div>
            <div>

                <a href="/logout">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 ">
                        <path fill-rule="evenodd"
                            d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </a>



            </div>
        </div>

        <div id="todos" class="grow m-auto max-w-full p-8 bg-gray-800 rounded-lg shadow-lg w-96 text-gray-200">

            <form action="/todos/save" method="POST">
                <div class="flex justify-center items-center">
                    <a href="/">Cancel</a>
                    <button type="submit" class="ml-6">Save</button>
                </div>
                <input type="text" name="_token" value="{{ session()->token() }}" hidden>
    
                @foreach ($todos as $todo)
                    <div>

                        <input id="{{ 'todo_'.$todo->id }}" class="hidden" name="{{$todo->id}}" type="checkbox" {{ $todo->checked ? 'checked' : '' }}>
                        <label for="{{ 'todo_'.$todo->id }}" class="flex items-center h-10 px-2 rounded cursor-pointer hover:bg-gray-900">
                            <span
                                class="flex items-center justify-center w-5 h-5 text-transparent border-2 border-gray-500 rounded-full">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span class="ml-4 text-sm">{{ $todo->title }}</span>
                        </label>
                    </div>
                @endforeach
            </form>

        </div>

        <div class="m-4 text-sm text-slate-500 text-center">
            dev by aungmoe
        </div>
    </div>
@endsection

