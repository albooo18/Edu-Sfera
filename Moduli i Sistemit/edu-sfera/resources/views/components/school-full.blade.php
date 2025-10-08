@if ($attributes->get('school') == 'UKZ')
    <div class="bg-blue-400 w-fit text-blue-700 font-extrabold px-3 py-2 text-xs rounded-full opacity-70">
      # Universiteti Kadri Zeka
    </div>
@elseif ($attributes->get('school') == 'UP')
    <div class="bg-green-400 w-fit text-green-700 font-extrabold px-3 py-2 text-xs rounded-full opacity-70">
      #Universiteti Hasan Prishtina
    </div>
@else
    <div class="bg-yellow-400 w-fit text-yellow-700 font-extrabold px-3 py-2 text-xs rounded-full opacity-70">
      #Universiteti i Shkencave te Aplikuara Ferizaj
    </div>
@endif
