<x-main-layout :title="__('Profile')">


    <div class="container p-5">
        @if(!$user->profile)
        <h1 class="text-center">{{__('Create Your Profile')}}</h1>
        <x-alert name="error" class="alert-danger" />


        <form action="{{route('profiles.store')}}" method="post" class="w-75 m-auto">
            @csrf


            <x-form.floating-control name="first_name">
                <x-slot:label>
                    <label for="first_name">First Name</label>
                </x-slot:label>
                <x-form.input name="first_name" />
            </x-form.floating-control>

            <x-form.floating-control name="last_name">
                <x-slot:label>
                    <label for="last_name">Last Name</label>
                </x-slot:label>
                <x-form.input name="last_name" />
            </x-form.floating-control>

            <div class="mb-4">
                <span>Choose your gender</span>
                <select name="gender" id="gender" class="form-select">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>


            <x-form.floating-control name="birthday">
                <x-slot:label>
                    <label for="birthday">Birthday</label>
                </x-slot:label>
                <x-form.input name="birthday" type="date" />
            </x-form.floating-control>

            <div class="mb-4">
                <span>Choose Language</span>
                <select name="locale" id="locale" class="form-select">
                    <option value="ar">Ar</option>
                    <option value="en">En</option>
                </select>
            </div>

            <x-form.floating-control name="timezone">
                <x-slot:label>
                    <label for="timezone">timezone</label>
                </x-slot:label>
                <x-form.input name="timezone" />
            </x-form.floating-control>

            <button class="btn btn-success" type="submit">{{__('Create')}}</button>
        </form>

        @else
        <div class="m-auto text-center">
            <h1 class="mb-3">{{__('Already profile Created')}}</h1>
            <a href="{{route('profiles.index')}}" class="btn btn-success">Go To Your Profile</a>
        </div>

        @endif
    </div>
    </x-main-layouts>