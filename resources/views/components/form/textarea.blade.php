@props([
    'value' => '', 'name' , 'id' => $name
])


<textarea 
      name="{{$name}}" 
      id="{{ $id ?? $name }}" 
      {{ $attributes
        ->class(['form-control' , 'is-invalid' => $errors->has($name)])}}
>{{old($name , $value)}}</textarea>

<x-form.errormsg name="{{ $name }}" />
