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
        <h5 class="mt-2 text-start">{{__('Join Link:')}}</h5>
        <span id="textToCopy" style="display: none;">{{$invitation_link}}</span>
        <button onclick="copyText()" class="btn btn-success"><i class="fas fa-copy"></i></button>
      </div>

      <div class="border rounded p-3 text-center mt-2">
        <h5 class="text-start">{{__('Class Code:')}}</h5>
        <span class="text-success fs-2 ">{{$classroom->code}}</span>
      </div>

      <div class="border rounded p-3 text-center mt-2">
        <h5 class="text-start">{{__('Upcoming')}}</h5>
        <h6 class="text-secondary">{{__('No work due soon')}}</h6>
      </div>

    </div>

    <div class="col-md-9">


      <form action="{{route('posts.store' , $classroom->id)}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$classroom->id}}">
        <input type="hidden" name="type" value="post">

        <div class="mb-3 shadow-sm p-2 d-flex align-items-center">
          <img src="https://ui-avatars.com/api/?name={{Auth::user()?->name}}&size=35" class="rounded-circle me-2" alt="">
          <input type="text" name="content" placeholder="{{__('Tell us something ..')}}" class="rounded-pill border border-none w-100 p-3 me-2">
          <button type="submit" class="btn btn-sm btn-success"><i class="far fa-paper-plane"></i></button>
        </div>

      </form>

      <div class="posts shadow-sm p-3">
        @foreach ($classroom->posts()->latest()->get() as $post)
          <div class="d-flex p-2 mt-2 align-items-center">
            <img src="{{asset('imgs/icon.png')}}" width="40" height="40" class="rounded-circle me-2" alt="">
            <div class="ms-2 mt-1">
              <h6 >{{ $post->user?->name }} {{__('add a new post :')}} {{ $post->content }}</h6>
              <span class="text-secondary">{{$post->created_at->format('j F')}}</span>
            </div>
          </div>
          @endforeach
        </div>

      </div>

    </div>

  </div>
</div>


@endsection