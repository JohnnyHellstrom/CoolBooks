<x-layout>


    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">Edit User: {{ $users->name }}</h2>
    </header>

    <div class="flex justify-center md:justify-center">
        <form method="POST" action="/admin/{{ $users->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- prevents cross-site scripting attacks -->

            <div class="mb-6">
                <p class="uppercase"><b>Current Role: {{ $users->roles->name }}</b></p>
                <br>
                <label for="role_id" class="inline-block text-lg mb-2"><b>Change Role</b></label>
                <select name="role_id">
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                    <option value="3">Moderator</option>
                </select>
                @error('role_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <div class="mb-6"><br>
                    <x-button-create>Save Changes</x-button-create>
                    <a href="/admin" class="text-black m-10 ml-4"><i class="fa-solid fa-arrow-left"></i> Back to
                        Admin</a>
                </div>
        </form>
    </div>

</x-layout>
