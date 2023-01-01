@props(['name'])

<label class="block mb-2 uppercase font-bold text-xs text-slate-200"
       for="{{ $name }}">
    {{ ucwords(preg_replace("/[^A-Za-z0-9\-]/"," ",$name)) }}
</label>