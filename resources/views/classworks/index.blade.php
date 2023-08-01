<x-main-layout :title="$classroom->name">


    @if(session()->has('sucess'))
    <div class="alert alert-success">
        {{ $success }}
    </div>
    @endif

    <div class="container pt-5">
        <h1>{{ $classroom->name }}</h1>
        <h3>Classworks <div class="dropdown mt-4">
                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    + Create
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('classrooms.classworks.create' , [$classroom->id , 'type' => 'assignment']) }}">Assignment</a></li>
                    <li><a class="dropdown-item" href="{{ route('classrooms.classworks.create' , [$classroom->id , 'type' => 'material']) }}">Material</a></li>
                    <li><a class="dropdown-item" href="{{ route('classrooms.classworks.create' , [$classroom->id , 'type' => 'question']) }}">Question</a></li>
                </ul>
            </div>
        </h3>
        <hr>

        @forelse($classworks as $group)
        <h3>{{ $group->first()->topic->name }}</h3>
        <div class="accordion accordion-flush" id="accordionFlushxample">
            @foreach($group as $classwork)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$classwork->id}}" aria-expanded="false" aria-controls="flush-collapseThree">
                        {{$classwork->title}}
                    </button>
                </h2>
                <div id="flush-collapse{{$classwork->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        {{$classwork->description}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @empty
        <p class="text-center fs-4 text-success">No Classworks Found.</p>
        @endforelse


    </div>





</x-main-layout>