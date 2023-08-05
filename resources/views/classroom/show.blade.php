@extends('layouts.secondNav')

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

      <div class="border rounded p-3 text-center d-flex justify-content-between">
        <h5 class="mt-2 text-start">Join Link:</h5>
        <span id="textToCopy" style="display: none;">{{$invitation_link}}</span>
        <button onclick="copyText()" class="btn btn-success"><i class="fas fa-copy"></i></button>
      </div>

      <div class="border rounded p-3 text-center mt-2">
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
      </div>

    </div>

  </div>
</div>


@endsection