<x-layout>
    <div class="flex flex-col gap-2">
        <div>
            <h2><b>Name:</b></h2>{{ $users->name }}
        </div>
        <div class="flex flex-row gap-20">
            <span>
                <h2><b>Current Role:</b></h2>{{ $users->roles->name }}
            </span>
            <div class="">
                <form method="POST" action="/admin/{{ $users->id }}">
                    @csrf
                    @method('PUT')
                    <!-- prevents cross-site scripting attacks -->

                    <div class="flex flex-row gap-4 items-center">

                        <label for="role_id" class="inline-block text-lg "><b>Change Role</b></label>
                        <select id="role" name="role_id" selected='{{ $users->role_id }}'>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                            {{-- <option value="3">Moderator</option> --}}
                        </select>
                        @error('role_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <div class="flex self-center mt-2"><br>
                            <button type="submit" name="form1">Submit 1</button>
                            {{-- <x-button-create>Save Changes</x-button-create> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="">
            <h2><b>User Id:</b></h2>{{ $users->id }}
        </div>
        <div>
            <h2><b>User Name:</b></h2>{{ $users->user_name }}
        </div>
        <div>
            <h2><b>Email:</b></h2>{{ $users->email }}
        </div>
        <div>
            <h2><b>Phone:</b></h2>{{ $users->phone }}
        </div>
        <div class="flex flex-row gap-20">
            <span>
                <h2><b>Is Deleted:</b></h2>{{ $users->is_deleted }}
            </span>
            <div class="">
                <form method="POST" action="/admin/{{ $users->id }}">
                    @csrf
                    @method('PUT')
                    <!-- prevents cross-site scripting attacks -->

                    <div class="flex flex-row gap-4 items-center">

                        <label for="is_deleted" class="inline-block text-lg "><b>Change Deletion</b></label>
                        <select name="is_deleted" selected='{{ $users->is_deleted }}'>
                            <option value="0">UnDeleted</option>
                            <option value="1">Deleted</option>
                        </select>
                        @error('is_deleted')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <div class="flex self-center mt-2"><br>
                            <button type="submit" name="form2">Submit 2</button>
                            {{-- <x-button-create>Save Changes</x-button-create> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <h2><b>Created:</b></h2>{{ $users->created_at }}
        </div>
        <div>
            <h2><b>Updated:</b></h2>{{ $users->updated_at }}
        </div>

    </div>

    {{-- <x-button-edit>
        <a class="flex-start" href="/admin/{{ $users->id }}/edit">Edit</a>
    </x-button-edit> --}}
</x-layout>
