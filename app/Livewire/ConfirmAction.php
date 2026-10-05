<?php

namespace App\Livewire;

use Livewire\Component;

class ConfirmAction extends Component
{
    public bool $show = false;
    public ?string $component = null;
    public ?string $method = null;
    public array $params = [];
    public string $title = 'تأكيد الحذف';
    public string $message = 'هل أنت متأكد من رغبتك في الحذف؟ لا يمكن التراجع عن هذا الإجراء.';
    public string $confirmText = 'نعم، احذف';
    public string $cancelText = 'إلغاء';

    protected $listeners = ['confirmAction' => 'open'];

    /**
     * @param string $component  اسم الكمبوننت
     * @param string $method     اسم الدالة 
     * @param array  $params     الباراميترز
     */
    public function open(
        string $component,
        string $method,
        array $params = [],
        ?string $title = null,
        ?string $message = null,
        ?string $confirmText = null,
        ?string $cancelText = null
    ) {
        $this->component = $component;
        $this->method = $method;
        $this->params = $params;
        $this->title = $title ?? 'تأكيد الحذف';
        $this->message = $message ?? 'هل أنت متأكد من رغبتك في الحذف؟ لا يمكن التراجع عن هذا الإجراء.';
        $this->confirmText = $confirmText ?? 'نعم، احذف';
        $this->cancelText = $cancelText ?? 'إلغاء';
        $this->show = true;
    }

    public function close()
    {
        $this->show = false;
        $this->component = null;
        $this->method = null;
        $this->params = [];
    }

    public function confirm()
    {
        if (!$this->component || !$this->method) {
            $this->close();
            return;
        }

        $this->dispatch($this->method, ...$this->params)
            ->to($this->component);

        $this->close();
    }

    public function render()
    {
        return view('livewire.confirm-action');
    }
}