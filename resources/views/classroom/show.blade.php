@extends('layouts.master')

@section('title' , 'Show')
@section('content')

<div class="container p-5">
  
  <div class="header position-relative border rounded w-100">
    <img src="{{ asset('uploads/' . $classroom->cover_image_path)}}" alt="..." class="w-100 border rounded">
    <div class="content position-absolute bottom-0 start-0 p-5  text-white">
      <h1>{{ $classroom->name }}</h1>
      <h2>{{ $classroom->subject }}</h2>
    </div>
  </div>

  <div class="row mt-3">

    <div class="col-md-3">
      <div class="border rounded p-3 text-center">
        <h5 class="text-start">Class Code:</h5>
        <span class="text-success fs-2 ">{{$classroom->code}}</span>
      </div>
      <div class="border rounded p-3 text-center mt-2">
        <h5 class="text-start">Upcoming</h5>
        <h6 class="text-secondary">No work due soon</h6>
      </div>
    </div>

    <div class="col-md-9">
      <div class="border rounded p-3 mb-2">
        <h5>invitation link :</h5>
        <a class="text-secondary fs-6" href="{{$invitation_link}}">{{$invitation_link}}</a>
      </div>

      <div class="border rounded p-3 mb-2">
        <a class="btn btn-outline-dark fs-6" href="{{route('classrooms.classworks.index' , $classroom->id)}}">Classworks</a>
      </div>

    </div>

  </div>
</div>

@endsection