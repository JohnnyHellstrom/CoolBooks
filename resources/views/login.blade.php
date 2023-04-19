<x-layout>
    <div class="flex justify-center md:justify-center">
        {{-- when uploading files etc you have to have the enctype="multipart/form-data" --}}
        <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-6">
            
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{old('email')}}"required autofocus>
                @error('email')
                <span>{{$message}}</span>
                @enderror
            </div>
            <div class="flex justify-center md:justify-center">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                <span>{{ $message }}</span>
                @enderror
            </div>
            <div>
                <button type="submit">Log in</button>
            </div>
        </form>
</x-layout>
