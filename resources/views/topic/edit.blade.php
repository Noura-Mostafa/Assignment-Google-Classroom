@extends('layouts.master')

@section('title' , 'edit')
@section('content')

<div class="container p-5">
    <h1>Edit Topic</h1>
    <form action="{{ route('topics.update' , $topic->id) }}" method="post">

        @csrf
        <!-- form method spoofing -->
        <input type="hidden" name="_method" value="put">
        {{ method_field('put')}}

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
            <input type="text" class="form-control" value="{{old('name')}}" id="name" placeholder="topic name" name="name">
            <label for="name">Topic Name</label>
        </div>
    
        <div class="form-floating mb-3">
            <button type="submit" class="btn btn-success">Update Topic</button>
        </div>
        
    </form>
</div>

@endsection