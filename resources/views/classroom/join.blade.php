<x-main-layout title="Join Classroom">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="border p-5 text-center">
            <h2>{{ $classroom->name }}</h2>
            <form action="{{ route('classrooms.join' , $classroom->id)}}" method="post">
                @csrf
                <button type="submit" class="btn btn-success">{{ __('Join') }}</button>
            </form>
        </div>
    </div>

</x-main-layout>