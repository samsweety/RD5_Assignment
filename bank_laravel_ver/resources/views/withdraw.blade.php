@extends('layouts.app') 


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>提款</h1>
                    @if(Auth::user()->display)
                    <p>帳戶存款：{{Auth::user()->cash}}  </p>
                    @else
                    <p>帳戶存款：******</p>
                    @endif
                    <button onclick="event.preventDefault();document.getElementById('display').submit()" class="btn-warning">
                    @if(Auth::user()->display)
                    隱藏
                    @else
                    顯示
                    @endif
                    </button>
                    <form id="display" style="display:none" method="get" action="/display" >
                        @csrf
                    </form>
                </div>
                <div class="card-body">     
                    <x-alert/>
                    <form method="post" action="/withdraw">
                    @csrf                    
                    <p>金額：<input type="text" name="value">
                    <input type="submit" value="提款"></p>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection