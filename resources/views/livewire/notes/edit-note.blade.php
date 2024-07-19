<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;

    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;
    public $noteIsPublish;

    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->fill($note);
        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteRecipient = $note->recipient;
        $this->noteSendDate = $note->send_date;
        $this->noteIsPublish = $note->is_published;
    }

    public function saveNote()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ]);

        $this->note->update([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => $this->noteIsPublish,
        ]);

        $this->dispatch('note-saved');
    }
}; ?>

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Edit Note') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 text-gray-900">
            <div class="mt-2">
                <form wire:submit="saveNote" class="space-y-2">
                    <x-input wire:model="noteTitle" label="Note Title" placeholder="It's been a greate day" />
                    <x-textarea wire:model="noteBody" label="Note Body" placeholder="Let's share your though with your friend" />
                    <x-input wire:model="noteRecipient" icon="user" type="email" label="Note Recipient"
                        placeholder="yourfriend@gmail.com" />
                    <x-input wire:model="noteSendDate" icon="calendar" type="date" label="Note Send Date" />
                    <x-checkbox label="Note Published" wire:model='noteIsPublish'></x-checkbox>
                    <div class="flex justify-between pt-4">
                        <x-button wire:click="saveNote" primary right-icon="calendar" spinner>Save Note</x-button>
                        <x-button href="{{ route('notes.index') }}" flat negative>Back to Notes</x-button>
                    </div>
                    <x-action-message on="note-saved" />
                </form>
            </div>
        </div>
    </div>
</div>
