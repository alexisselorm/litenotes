<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $note->trashed() ? __('Trash') : __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-white">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            <div class="flex">
                @if (!$note->trashed())
                    <p class="opacity-70">
                        <strong>Created: </strong> {{ $note->created_at->diffForHumans() }}
                    </p>
                    <p class="opacity-70 ml-8">
                        <strong>Updated: </strong> {{ $note->updated_at->diffForHumans() }}
                    </p>
                    <a href="{{ route('notes.edit', $note) }}" class="btn-link ml-auto">Edit Note</a>
                    <form action="{{ route('notes.destroy', $note) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger ml-4" type="submit"
                            onclick="return confirm('Are you sure you want to delete this note?')">Move to
                            Trash</button>

                    </form>
                @else
                    <p class="opacity-70">
                        <strong>Deleted at: </strong> {{ $note->created_at->diffForHumans() }}
                    </p>

                    <form action="{{ route('trashed.update', $note) }}" method="post" class="ml-auto">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn-link">Restore Note</button>

                    </form>
                    <form action="{{ route('trashed.destroy', $note) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger ml-4" type="submit"
                            onclick="return confirm('Are you sure you want to delete this note forever? This cannot be undones')">Delete
                            Forever</button>

                    </form>
                @endif

            </div>
            <div class="my-6 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">{{ $note->title }}</h2>
                <p class="mt-6 whitespace-pre-wrap">{{ Str::limit($note->text, 200) }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
