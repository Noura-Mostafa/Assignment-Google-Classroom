<x-main-layout :title="$classroom->name">

    <div class="container pt-5">
        <div class="row">

            <div class="col-lg-9">
                <div class="header d-flex">
                    <div>
                        <img src="{{asset('imgs/icon.png')}}" width="40" height="40" alt="" class="me-3">
                    </div>
                    <div class="content w-100">
                        <h2 class="text-success"> {{$classwork->title}}</h2>
                        <p class="text-secondary">{{auth()->user()->name}} . {{$classwork->published_at}}</p>
                        <hr class="text-success">
                        <p class="description">{{$classwork->description}}</p>
                        <hr class="text-success">
                        <h6><i class="fas fa-users text-success"></i> Class comments</h6>

                        <h6 class="text-success text-decoration-none mt-2">Add a class comment</h6>

                    </div>
                </div>
            </div>


            <div class="col-lg-3">
                <form action="{{route('comments.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$classwork->id}}">
                    <input type="hidden" name="type" value="classwork">


                    <div class="shadow-sm p-3 rounded">
                        <h6><i class="fas fa-users text-success"></i> Class comments</h6>
                        @foreach ($classwork->comments()->latest()->get() as $comment)
                        <div class="d-flex p-2 d-flex mt-2 align-items-center">
                            <img src="https://ui-avatars.com/api/?name={{$comment->user?->name}}&size=35" class="rounded-circle me-2" alt="">
                            <span class="text-secondary">{{ $comment->user?->name }} . Time: {{$comment->created_at->diffForHumans(null , true , true)}}</span>
                        </div>
                        <h6 class="text-center mt-1">{{ $comment->content }}</h6>
                        @endforeach

                        <div class="mb-2 p-2 d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name={{Auth::user()?->name}}&size=35" class="rounded-circle me-2" alt="">
                            <input type="text" name="content" placeholder="Add comment.." class="rounded-pill border border-none w-75 p-2 me-2">
                            <button type="submit" class="btn btn-sm btn-success"><i class="far fa-paper-plane"></i></button>
                        </div>

                    </div>

                </form>
            </div>


        </div>

    </div>

</x-main-layout>