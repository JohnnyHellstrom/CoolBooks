<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#ef3b2d",
                        },
                    },
                },
            };
        </script>
        <title>CoolBooks</title>
    </head>
    <body class="mb-48 bg-gray-400">
        <nav class="flex justify-between mb-4 bg-slate-500" >
            <a href="/"><img class="w-32" src="{{asset('images/logo.png')}}" alt="" class="logo"/></a>
            <ul class="flex items-end space-x-6 mr-6 text-lg">
                <li>
                    <a href="/books" class="hover:text-laravel"><i class="fa fa-book"></i>Books</a>
                </li>
                <li>
                  <a href="/authors" class="hover:text-laravel"><i class="fa-solid fa-pen-nib"></i>Authors</a>
                </li>
                <li>
                  <a href="/genres" class="hover:text-laravel"><i class="fa-solid fa-masks-theater"></i>Genres</a>
                </li>
                <li>
                  <a href="/reviews" class="hover:text-laravel"><i class="fa-solid fa-pen-to-square"></i>Reviews</a>
                </li>
                <li>
                    <form method="GET" class="inline" action="/logout">
                    @csrf
                    <button type="submit"><i class="fa-solid fa-door-closed"></i>Logout</button>
                    </form>
                </li>
                <li>
                    <a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
                </li>
                <li>
                    <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i>Login</a>
                </li>
            </ul>
        </nav>
<main>
   {{$slot}}
</main>

<footer
    class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-slate-500 text-white h-20   md:justify-center">
    <a href="/" class="absolute top-1/3 left-10 bg-black text-white py-2 px-5">About</a>
    <a href="/" class="absolute top-1/3 left-36 bg-black text-white py-2 px-5">Contact</a>
    <p class="ml-2">Copyright &copy; 2023, All Rights reserved</p>
    <a href="/" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Home page</a>
</footer>
<x-flash-message />
</body>
</html>