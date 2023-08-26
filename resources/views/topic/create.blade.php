@extends('layouts.master')

@section('title' , 'create')
@section('content')

<div class="container p-5">
    <h1>{{__('Create Topic')}}</h1>
    <form action="{{ route('topics.store' , $classroom->id) }}" method="post">

        @csrf

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" placeholder="topic name" name="name">
            <label for="name">Topic Name</label>
        </div>

        <div class="form-floating mb-3">
            <button type="submit" class="btn btn-success">{{__('Create Topic')}}</button>
        </div>
    </form>
</div>

@endsection