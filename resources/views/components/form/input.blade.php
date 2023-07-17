@props([
    'value' => '', 'name'
])


<input 
      value="{{old($name , $value)}}" 
      name="{{$name}}" 
      id="{{ $id ?? $name }}" 
      {{ $attributes
        ->merge([ 'type' => 'text'])
        ->class(['form-control' , 'is-invalid' => $errors->has($name)])}}
>

<x-form.errormsg name="{{ $name }}" />
