@extends('layouts.master')

@section('title' , 'Show')
@section('content')

<div class="container p-5">
  <div class="header border rounded text-center p-3 w-75 m-auto text-white">
    <h3>{{ $classroom->name }}</h3>
    <h5>{{ $classroom->subject }}</h5>
  </div>

  <div class="row mt-3">
    <div class="col-md-3">
      <div class="border rounded p-3 text-center">
        <span class="text-success fs-2">{{$classroom->code}}</span>
      </div>
      <a href="{{ route('topics.create') }}" class="btn btn-success mt-2">Create Topic</a>
      <div class="border rounded p-3 mt-4">
      <h3>Class Topics</h3>
      @foreach ($topic as $topic)
      <h4 class="text-success">{{'- ' .  $topic->name}}</h4>
      @endforeach
      </div>
    </div>
    <div class="col-md-9">
    </div>
  </div>
</div>

@endsection