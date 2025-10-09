@props(['active' => false])


<a class="{{ $active ? 'border-b-2 border-green-700' : "" }} py-6 px-3 text-xl hover:text-green-700" 
    {{ $attributes }}>
    {{ $slot }}</a>