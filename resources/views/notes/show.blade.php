<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-white">
            <div class="flex">
                <p class="opacity-70">
                    <strong>Created: </strong> {{ $note->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated: </strong> {{ $note->updated_at->diffForHumans() }}
                </p>
            </div>
            <div class="my-6 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">{{ $note->title }}</h2>
                <p class="mt-6 whitespace-pre-wrap">{{ Str::limit($note->text, 200) }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
