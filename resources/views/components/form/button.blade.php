@props(['form_id'=>null])

<x-form.field>
    @if($form_id)
    <button type="submit" form='{{$form_id}}' id ='dddd' class="savebtn bg-gray-400 text-gray-800  uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-500">
        {{ $slot }}
    </button>
    @else
    <button type="submit" class="bg-gray-400 text-gray-800  uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-500">
        {{ $slot }}
    </button>
    @endif
</x-form.field>