<x-layout>
    {{-- @include('partials._admin-nav') --}}
    <div class="flex flex-col">
        @foreach ($users as $user)
            <a href="/admin/{{ $user->id }}" class="hover:text-laravel">{{ $user->user_name }}</a>
        @endforeach
    </div>
</x-layout>
