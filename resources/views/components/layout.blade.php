<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" defer charset="utf-8"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tiny.cloud/1/surnp6umx1mcegjvj0kdkgzkhebu6s40tdj8tdkfd4z4mrtr/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                        background: "#E5F0EC",
                        logo: "#98A2A2",
                        nav: "#64748b",
                        footer: "#64748b",
                        main: "#9ca3af",
                        hero: "#64748b",

                    },
                },
            },
        };
    </script>
    <title>CoolBooks</title>
</head>

<body class="bg-background m-2 mb-24">
    <span class="flex justify-center mb-4 bg-main">
        <a href="/"><img class="w-32 " src="{{ asset('images/logo.png') }}" alt="" class="logo" /></a>
    </span>
    @auth
      
            <span class="flex justify-center mb-4 bg-nav font-bold text-xl">
                Welcome to CoolBooks, {{ auth()->user()->user_name }}
            </span>
        
    @endauth
    {{-- <div class="flex w-full"> --}}
    <nav class="mb-4 bg-nav grid-container">

            <div class="justify-self-end gap-4">
 
                <a class="pl-2" href="/books" class="hover:text-laravel"><i class="fa fa-book p-1"></i>Books</a>

                
                <a class="pl-2" href="/authors" class="hover:text-laravel"><i class="fa-solid fa-pen-nib p-1"></i>Authors</a>
                
                <a class="pl-2" href="/quotes" class="hover:text-laravel"><i class="fa-solid fa-quote-right p-1"></i>Quotes</a>
                
                <a class="pl-2" href="/toplist/index" class="hover:text-laravel"><i class="fa-solid fa-arrow-up-right-dots p-1"></i>Toplists</a>
                
                @can('view-button-for-moderator')
                
                <a class="pl-2" href="/reviews" class="hover:text-laravel"><i class="fa-solid fa-pen-to-square p-1"></i>Reviews</a>
                
                @endcan
                
                @can('view-button-for-admin')
                
                <a class="pl-2" href="/genres" class="hover:text-laravel"><i class="fa-solid fa-masks-theater p-1"></i>Genres</a>
                
                <a class="pl-2" href="/charts" class="hover:text-laravel"><i class="fa-solid fa-chart-simple p-1"></i>Statistics</a>
                
                <a class="pl-2" href="/admin" class="hover:text-laravel"><i class="fa-solid fa-pen-to-square p-1"></i>Admin</a>
                
                @endcan
            </div>
            <div class="justify-self-end mr-4">
                @auth

                    <form method="post" class="inline" action="/logout">
                        @csrf
                        <button type="submit"><i class="fa-solid fa-door-closed p-1"></i>Logout</button>
                    </form>

                @else

                    <a class="pl-2" href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus p-1"></i> Register</a>

                    <a class="pl-2" href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket p-1"></i>Login</a>

                @endauth
            </div>
 
    </nav>
{{-- </div> --}}
    <main class="w-2/3 flex flex-col bg-gray-400 p-4 m-auto mb-5">
        {{ $slot }}
    </main>

    <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-footer text-white h-20 md:justify-center">
        <a href="/about" class="absolute top-1/4 left-10 bg-black text-white py-2 px-5">About</a>
        <a href="/contact" class="absolute top-1/4 left-36 bg-black text-white py-2 px-5">Contact</a>
        <div class="absolute top-1/5 left-60 text-white py-2 px-5 flex">
            <a href="/"><img class="p-2"
                    src="{{ asset('/images/5296499_fb_facebook_facebook logo_icon.png') }}" alt="FaceBook"
                    width="50" /></a>
            <a href="/"><img class="p-2"
                    src="{{ asset('/images/5296501_linkedin_network_linkedin logo_icon.png') }}" alt="LinkedIn"
                    width="50" /></a>
            <a href="/"><img class="p-2"
                    src="{{ asset('/images/5296516_tweet_twitter_twitter logo_icon.png') }}" alt="Twitter"
                    width="50" /></a>
            <a href="/"><img class="p-2"
                    src="{{ asset('/images/5296765_camera_instagram_instagram logo_icon.png') }}" alt="Instagram"
                    width="50" /></a>
        </div>
        <p class="ml-2">Copyright &copy; 2023, All Rights reserved</p>
        <a href="#top" class="absolute top-1/4 right-44 bg-black text-white py-2 px-5" id="myBtn">Back To Top</a>
        <a href="/" class="absolute top-1/4 right-10 bg-black text-white py-2 px-5">Home page</a>
    </footer>
    <x-flash-message />
</body>

</html>

<script>
    let mybutton = document.getElementById("myBtn");

    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }
</script>