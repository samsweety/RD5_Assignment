<div>
    
    @if(session()->has('message'))
    {{$slot}}
    <div class="bg-primary text-center well-lg">{{ session()->get('message') }}</div>
    @elseif(session()->has('error'))
    {{$slot}}
    <div class="bg-danger text-center">{{ session()->get('error') }}</div>
    @endif

    @if($errors->any())
    <div class="bg-danger text-center">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>