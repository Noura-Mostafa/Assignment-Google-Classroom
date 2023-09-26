<x-main-layout :title="$classroom->name">

    <div class="container pt-5">

        <x-alert name="success" class="alert-success" />
        <x-alert name="error" class="alert-danger" />

        <div class="row">
            <div class="col-lg-9">
                <div class="header d-flex">
                    <div>
                        <img src="{{asset('imgs/icon.png')}}" width="40" height="40" alt="" class="me-3">
                    </div>
                    <div class="content w-100">
                        <h2 class="text-success"> {{$classwork->title}}</h2>
                        <p class="text-secondary">{{$classwork->user->name}} . {{$classwork->published_at}}</p>
                        <hr class="text-success">
                        <p class="description">{!! $classwork->description !!}</p>
                        <hr class="text-success">
                        <h6><i class="fas fa-users text-success"></i> {{__('Class comments')}}</h6>

                        <h6 class="text-success text-decoration-none mt-2">{{__('Add a class comment')}}</h6>

                    </div>
                </div>
            </div>


            <div class="col-lg-3">
            <div class="shadow-sm p-3 rounded mb-2">
                @can('submissions.show' , [$classwork])
                <ul>
                    @foreach($student_submissions as $submission)
                    <li class="mb-1"><a href="{{route('submissions.file' , $submission->id)}}" class="btn btn-light">File #{{$loop->iteration}}</a></li>
                    @endforeach
                </ul>
                @endcan
            </div>
            
                <div class="shadow-sm p-3 rounded mb-2">

                    @if($submissions->count())
                    <ul>
                        @foreach ($submissions as $submission)
                        <li class="mb-1"><a href="{{route('submissions.file' , $submission->id)}}" class="btn btn-light">File #{{$loop->iteration}}</a></li>
                        @endforeach
                    </ul>
                    @else

                    @can('submissions.create' , [$classwork])
                    <form action="{{route('submissions.store' , $classwork->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <x-form.floating-control name="files.0">
                            <x-slot:label>
                                <label for="files">Upload Files</label>
                            </x-slot:label>
                            <x-form.input name="files[]" multiple type="file" accept="image/*,application/pdf" placeholder="Select files" />
                        </x-form.floating-control>


                        <button type="submit" class="btn btn-success w-100 mt-2">{{__('Submit')}}</button>
                    </form>
                    @endcan

                    @endif
                </div>

                <form action="{{route('comments.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$classwork->id}}">
                    <input type="hidden" name="type" value="classwork">


                    <div class="shadow-sm p-3 rounded">
                        <h6><i class="fas fa-users text-success"></i> {{__('Class comments')}}</h6>
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