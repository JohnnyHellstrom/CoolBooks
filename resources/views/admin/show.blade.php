<x-layout>
    <div class="flex flex-col gap-2">
        <div>
            <h2><b>Name:</b></h2>{{ $users->name }}
        </div>
        <div>
            <h2><b>Role:</b></h2>{{ $users->roles->name }}
        </div>
        <div>
            <h2><b>User Id:</b></h2>{{ $users->id }}
        </div>
        <div>
            <h2><b>Role Id:</b></h2>{{ $users->role_id }}
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
        <div>
            <h2><b>Is Deleted:</b></h2>{{ $users->is_deleted }}
        </div>
        <div>
            <h2><b>Created:</b></h2>{{ $users->created_at }}
        </div>
        <div>
            <h2><b>Updated:</b></h2>{{ $users->updated_at }}
        </div>

    </div>
    <br>
    <x-button-edit>
        <a class="flex-start" href="/admin/{{ $users->id }}/edit">Edit</a>
    </x-button-edit>
</x-layout>
