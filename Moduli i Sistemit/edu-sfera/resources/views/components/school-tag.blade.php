@if ($attributes->get('school') == 'UKZ' || $slot == 'UKZ')
    <div  {{ $attributes->merge(['class' => 'bg-blue-400 w-fit text-blue-700 font-extrabold px-3 py-2 text-xs rounded-full opacity-70']) }} >
        #UKZ
    </div>
@elseif ($attributes->get('school') == 'UP' || $slot == 'UP')
    <div {{ $attributes->merge(['class' => "bg-green-400 w-fit text-green-700 font-extrabold px-3 py-2 text-xs rounded-full opacity-70"]) }}>
        #UP
    </div>
@elseif ($attributes->get('school') == 'USHAF' || $slot == 'USHAF')
    <div {{ $attributes->merge(['class' => "bg-yellow-400 w-fit text-yellow-700 font-extrabold px-3 py-2 text-xs rounded-full opacity-70"]) }}>
        #USHAF
    </div>
@else
    <div class="w-fit font-extrabold px-3 py-2 text-xs rounded-full opacity-70">
        {{ $slot }}
    </div>
@endif
