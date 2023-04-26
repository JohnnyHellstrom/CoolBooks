<x-layout>
    {{ $users->name }}

    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">Edit User</h2>
    </header>

    <div class="flex justify-center md:justify-center">
        <form method="POST" action="/admin/{{ $users->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- prevents cross-site scripting attacks -->

            <div class="mb-6">
                <label for="role_id" class="inline-block text-lg mb-2">Role</label>
                <p>1: Admin 2: User</p>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="role_id"
                    placeholder="E.g. Jane" value="{{ $users->role_id }}" />
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
