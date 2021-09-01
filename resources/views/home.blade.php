@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="background-color:#154360">
        <div class="col-md-8">
            <div class="card text-center" style="background-color:#2E4053;">
                <div class="card-header text-white">Welcome  <span class="text-primary">{{Auth()->user()->name}}</span> </div>
            <div class=" card-body text-center">
            <img src="{{URL::asset('img/dancingwithdeath.jpg')}}" width="300px" class="text-center">
            </div>
                <div class="card-footer text-white">
                Do you want to have a date with death ?
                </div>
                <div class="card-text text-white">
               <a class="btn btn-block btn-success"  style="background-color:#21618C" href="{{ route('appointments.index') }}">Yes, I do</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
