<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;

    public function submit()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ]);

        auth()
            ->user()
            ->notes()
            ->create([
                'title' => $this->noteTitle,
                'body' => $this->noteBody,
                'recipient' => $this->noteRecipient,
                'send_date' => $this->noteSendDate,
                'is_published' => false,
            ]);

        redirect(route('notes.index'));
    }
}; ?>

<div>
    <form wire:submit="submit" class="space-y-2">
        <x-input wire:model="noteTitle" label="Note Title" placeholder="It's been a greate day" />
        <x-textarea wire:model="noteBody" label="Note Body" placeholder="Let's share your though with your friend" />
        <x-input wire:model="noteRecipient" icon="user" type="email" label="Note Recipient"
            placeholder="yourfriend@gmail.com" />
        <x-input wire:model="noteSendDate" icon="calendar" type="date" label="Note Send Date" />
        <div class="pt-4">
            <x-button wire:click="submit" primary right-icon="calendar" spinner>Schedule Note</x-button>
        </div>
    </form>
</div>