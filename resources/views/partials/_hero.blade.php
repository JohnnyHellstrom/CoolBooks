<section
            class="relative h-72 bg-emerald-400 flex flex-col justify-center align-center text-center space-y-4 mb-4">

            <div class="z-10">
                <a href="/books/{{$one_book->title}}"><img
                    class="w-48 mr-6 mb-6"
                    src="{{$one_book->image ? asset('storage/' . $one_book->image) : asset('images/no-image2.png')}}"
                    alt=""/>{{$one_book->title}}</a>
                    <p>{{$one_book->description}}</p>

            </div>
        </section>