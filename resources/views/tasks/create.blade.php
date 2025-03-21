<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Task</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf

                    {{-- Title --}}
                    <div class="mb-4">
                        <x-input-label for="title" value="Title" />
                        <x-text-input id="title" name="title" type="text" :value="old('title')" required
                            autofocus />
                        <x-input-error :messages="$errors->get('title')" />
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <x-input-label for="description" value="Description" />
                        <x-textarea id="description" name="description"
                            rows="5">{{ old('description') }}</x-textarea>
                        <x-input-error :messages="$errors->get('description')" />
                    </div>

                    {{-- Due Date --}}
                    <div class="mb-6">
                        <x-input-label for="due_date" value="Due Date" />
                        <x-text-input id="due_date" name="due_date" type="date" :value="old('due_date')" required />
                        <x-input-error :messages="$errors->get('due_date')" />
                    </div>

                    <div class="flex justify-end space-x-3">
                        <x-secondary-button href="{{ route('tasks.index') }}">Cancel</x-secondary-button>
                        <x-primary-button>Save Task</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
