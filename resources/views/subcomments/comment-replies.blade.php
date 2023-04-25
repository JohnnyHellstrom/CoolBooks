
<div id="subcomments-comment-{{$comment->id}}" class=" hidden">
   @foreach($comment->subcomments as $subcomment)
   <div class="flex flex-col">
      <div class="flex">
         <form method="POST" action="/subcomments/flag/{{$subcomment->id}}">
            @csrf
            <button><i class="fa-sharp fa-regular fa-flag fa-2xs p-1"></i></button>
         </form>
         <span class="pr-2"><i> {{$subcomment->timeSinceReply()}} </i></span>
         <p class="pr-1"><b> {{$subcomment->users->user_name . ":"}} </b></p>
      </div>
      <p class="pl-4"> {{$subcomment->subcomment}} </p>
   </div>
   @endforeach
</div>
