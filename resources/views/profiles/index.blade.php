<x-main-layout :title="__('Profile')">


    <div class="container pt-5">
    <div class="text-center">
    <img src="https://ui-avatars.com/api/?name={{auth()->user()->name}}&size=120" class="rounded-circle me-2" alt="">
    <h2>{{$profile->first_name}}</h2>
    </div>


    <div class="m-auto border rounded w-50 mt-5 p-3">

    <h5 class="mb-2"><span class="btn btn-sm btn-success">{{__('First Name :')}}</span> {{$profile->first_name}}</h5>
    <h5 class="mb-2"><span class="btn btn-sm btn-success">{{__('Last Name :')}}</span> {{$profile->last_name}}</h5>
    <h5 class="mb-2"><span class="btn btn-sm btn-success">{{__('Gender :')}}</span> {{$profile->gender}}</h5>
    <h5 class="mb-2"><span class="btn btn-sm btn-success">{{__('Language :')}}</span> {{$profile->locale}}</h5>
    <h5 class="mb-2"><span class="btn btn-sm btn-success">{{__('Birthday :')}}</span> {{$profile->birthday->format('Y-m-d')}}</h5>
    <h5 class="mb-2"><span class="btn btn-sm btn-success">{{__('TimeZone :')}}</span> {{$profile->timezone}}</h5>
    <a href="{{route('profiles.edit' , $profile->id)}}" class="btn btn-dark btn-sm mt-2">Edit Your profile</a>
    </div>



    </div>
    </x-main-layouts>