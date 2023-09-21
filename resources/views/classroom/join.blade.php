<x-main-layout title="Join Classroom">
    
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="border rounded p-5 text-center">
            <img src="{{asset('/imgs/Google_Classroom_Logo.svg.png')}}" class="img-fluid" height="100" width="100" alt="">
            <h2 class="mt-3">Welcome to GoogleClasssroom</h2>
            <p class="fs-3">This is an invitaion to join a <span class="text-success fs-4">{{ $classroom->name }}</span></p>
            <form action="{{ route('classrooms.join' , $classroom->id)}}" method="post">
                @csrf
                <button type="submit" class="btn btn-lg btn-success">{{ __('Join Classroom') }}</button>
            </form>
        </div>
    </div>

</x-main-layout>