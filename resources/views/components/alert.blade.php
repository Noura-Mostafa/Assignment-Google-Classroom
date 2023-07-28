<div>
    @props([
    'name'
    ])

    @php
    $class = $name == 'error' ? 'danger' : 'success'
    @endphp

    @if (session()->has($name))
    <div class="alert alert-{{ $class }} p-2 h-25" {{ $attributes }}>
        {{ session($name) }}
    </div>
    @endif
</div>