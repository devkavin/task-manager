<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                My Tasks
            </h2>

            <a href="{{ route('tasks.create') }}"
                class="ml-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + New Task
            </a>
        </div>
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

            @forelse ($tasks as $task)
                <div class="bg-white shadow-sm rounded-lg p-4 sm:p-6 mb-4">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                        {{-- Left content --}}
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-800">{{ $task->title }}</h3>
                            <p class="text-gray-600">
                                {{ $task->description }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                Created {{ $task->created_at->diffForHumans() }}
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

                        {{-- Right action buttons --}}
                        <div class="flex flex-wrap gap-2 sm:justify-end">
                            <button type="button" data-task-id="{{ $task->id }}"
                                class="toggle-status-btn px-3 py-1 text-sm rounded transition
                                {{ $task->status === 'Pending'
                                    ? 'bg-green-100 text-green-800 hover:bg-green-200'
                                    : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }}">
                                {{ $task->status === 'Pending' ? 'Mark Complete' : 'Mark Pending' }}
                            </button>

                            <a href="{{ route('tasks.edit', $task) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">
                                Edit
                            </a>

                            <button type="button"
                                class="delete-task-btn bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm"
                                data-task-id="{{ $task->id }}">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-gray-500">
                    <p class="text-lg">No tasks found.</p>
                    <p class="mt-2 mb-10 text-sm">Get started by creating a new task.</p>
                </div>
            @endforelse

            <div class="mt-6">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.toggle-status-btn');

        buttons.forEach(btn => {
            btn.addEventListener('click', function() {
                const taskId = btn.getAttribute('data-task-id');

                fetch(`/tasks/${taskId}/toggle-status`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            location
                                .reload();
                        } else {
                            alert(data.message || 'Failed to update status.');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Something went wrong.');
                    });
            });
        });

        // Delete button
        document.querySelectorAll('.delete-task-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (!confirm('Are you sure you want to delete this task?')) return;

                const taskId = btn.getAttribute('data-task-id');
                const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content');

                fetch(`/tasks/${taskId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json',
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            location
                                .reload();
                        } else {
                            alert('Failed to delete task.');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Something went wrong.');
                    });
            });
        });

    });
</script>
