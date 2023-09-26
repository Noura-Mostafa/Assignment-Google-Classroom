<x-main-layout :title="__('Submissions')">

    <div class="container mt-5">
        <div class="row">
            @foreach($submissions as $submission)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body p-4">
                        <h6>Classwork {{$submission->classwork->title}} Submissions</h6>
                        <h6>{{$submission->classwork->classroom->name}}</h6>
                        <p class="text-success">{{$submission->count()}} Submission</p>
                        {{--<small>{{ $submission->classwork->users->first()->name }}</small>--}}
                        <a href="{{route('submissions.file' , $submission->id)}}" class="btn btn-light">File #{{$loop->iteration}}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</x-main-layout>













{{--
<div class="card-body">
    <form method="POST" action="{{ route('submissions.grade.update') }}">
        @csrf
        @method('PUT')

        <!-- Blade code for rendering the "Grade" input field -->
        <x-form.floating-control name="grade">
            <x-slot:label>
                <label for="grade">Grade</label>
            </x-slot:label>
            <x-form.input name="grade" type="number" min="0" id="grade" />
        </x-form.floating-control>

        <!-- Submit button -->
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit Grade</button>
        </div>
    </form>
</div>
--}}