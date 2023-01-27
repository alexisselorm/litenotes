<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('notes.store') }}" method="post">
                    @csrf
                    <x-text-input type="text" name="title" field='title' placeholder="Title" class="w-full"
                        autocomplete="off" :value="old('title')">
                    </x-text-input>
                    <x-textarea name="text" field='text' placeholder="Start typing here..." rows="10"
                        class="w-full" :value="old('text')">
                    </x-textarea>

                    <x-primary-button class="mt-6">Save Note</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
