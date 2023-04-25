<x-layout>
    <div class="flex flex-col gap-2">
        {{-- {{ dd($users) }} --}}
        <div>{{ $users->name }}</div>
        <div>{{ $users->id }}</div>
        <div>{{ $users->role_id }}</div>
        <div>{{ $users->user_name }}</div>
        <div>{{ $users->email }}</div>
        <div>{{ $users->phone }}</div>
        <div>{{ $users->is_deleted }}</div>
        <div>{{ $users->created_at }}</div>
        <div>{{ $users->updated_at }}</div>
    </div>

</x-layout>
