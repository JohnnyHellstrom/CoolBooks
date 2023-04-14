<button {{$attributes->merge(['class' => 'w-48  text-white font-bold
         py-2 px-4 rounded-full 
         bg-gray-500
         hover:bg-emerald-700'])}}
         >
   {{$slot}}  
</button>