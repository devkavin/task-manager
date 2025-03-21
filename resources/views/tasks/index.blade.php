<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Tasks</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="flex justify-end mb-4">
                <a href="{{ route('tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + New Task
                </a>
            </div>

            @forelse ($tasks as $task)
                <div class="bg-white shadow-sm rounded-lg p-6 mb-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold">{{ $task->title }}</h3>
                            <p class="text-gray-600">
                                {{ Str::limit($task->description, 50) }}
                            </p>
                            <p class="text-sm mt-2">
                                Due: <span class="font-medium">{{ $task->due_date->format('M d, Y') }}</span> |
                                Status:
                                <span
                                    class="inline-block px-2 py-1 rounded-full text-xs font-semibold
    {{ $task->status === 'Completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $task->status }}
                                </span>
                            </p>
                        </div>

                        <div class="flex gap-2">
                            <form method="POST" action="{{ route('tasks.toggleStatus', $task) }}">
                                @csrf
                                @method('PATCH')
                                <button title="Mark as {{ $task->status === 'Pending' ? 'Completed' : 'Pending' }}"
                                    class="bg-gray-100 px-3 py-1 rounded hover:bg-gray-200 text-sm w-24 rounded transition {{ $task->status === 'Pending'
                                        ? 'bg-green-100 text-green-800 hover:bg-green-200'
                                        : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }}">
                                    {{ $task->status === 'Pending' ? 'Complete' : 'Pending' }}
                                </button>
                            </form>

                            <a href="{{ route('tasks.edit', $task) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                                onsubmit="return confirm('Are you sure you want to delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">You have no tasks yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
