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
                        <h6><img src="{{asset('imgs/icon2.png')}}" alt="" width="20" height="20"> Class comments</h6>
                        <a href="" class="text-success text-decoration-none">Add a class comment</a>
                    </div>
                </div>
            </div>


            <div class="col-lg-3  p-5">

            </div>


        </div>

    </div>

</x-main-layout>