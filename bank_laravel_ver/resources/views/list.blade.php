@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>明細</h1>
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
                   <table class="table">
                        <tr>
                            <td>操作</td>
                            <td>金額</td>
                            <td>時間</td>
                        </tr>
                   @foreach($accdetails as $acc)
                        @if($acc->id!=Auth::user()->id)
                            @continue
                        @endif
                        <tr>
                            @if($acc->operate==1)
                            <td class="text-success">存款</td>
                            @else
                            <td class="text-danger">提款</td>
                            @endif
                            <td>{{$acc->amount}}</td>
                            <td>{{$acc->ts}}</td>
                        </tr>

                    @endforeach
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection