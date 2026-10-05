<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Messages extends Component
{
    public array $messages = []; // [['type' => 'success', 'text' => '...']]

    #[On('notify')]
    public function addMessage($type = 'info', $message = '')
    {
        $id = uniqid();
        $this->messages[] = [
            'id'    => $id,
            'type'  => $type,
            'text'  => $message,
        ];

        // اختفاء تلقائي بعد 4 ثواني
        $this->dispatch('auto-dismiss', id: $id);
    }

    public function remove($id)
    {
        $this->messages = array_values(
            array_filter($this->messages, fn($m) => $m['id'] !== $id)
        );
    }

    public function render()
    {
        return view('livewire.messages');
    }
}