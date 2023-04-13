<button {{$attributes->merge(['class' => 'w-48  text-white font-bold
         py-2 px-4 rounded-full 
         bg-emerald-300
         hover:bg-emerald-700'])}}
         >
   {{$slot}}  
</button>