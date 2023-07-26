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
      <div class="border rounded p-3 mt-2">
      <h5>Class Topics:</h5>
      @foreach ($topics as $topic)
      <h6 class="text-success">{{'- ' .  $topic->name}}</h6>
      @endforeach
      </div>
      <a href="{{ route('topics.create' , $classroom->id) }}" class="btn btn-success mt-2">Create Topic</a>
    </div>
    <div class="col-md-9">
      <div class="border rounded p-3 mb-2">
      <h5>invitation link :</h5>
      <a class="text-secondary fs-6" href="{{$invitation_link}}">{{$invitation_link}}</a>
      </div>
      <!-- <div class="post border rounded row">
        <div class="col-lg-1 bg-secondary-subtle">
          <img src="{{ asset('imgs/avatar-05.png') }}" alt="" class="rounded-circle text-center h-100 w-100">
        </div>
        <div class="col-lg-11 p-3">
          <a href="" class="text-secondary text-decoration-none text-start">Annonce something to your class</a>
        </div>
      </div> -->
    </div>
  </div>
</div>

@endsection