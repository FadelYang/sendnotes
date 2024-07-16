<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create a Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900">
                <div class="mt-2 space-y-2">
                    <x-button icon="arrow-left" class="mb-10" href="{{ route('notes.index') }}" secondary>All Notes</x-button>
                    <livewire:notes.create-note />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
