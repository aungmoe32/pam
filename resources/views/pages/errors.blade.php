@isset($errors)
    @foreach ($errors->all() as $msg)
        <div class="bg-red-400 p-5">
            {{ $msg }}
        </div>
    @endforeach
@endisset
