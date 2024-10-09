<?php
namespace App\Traits;

trait Toastable
{
    public function toastSuccess(string $message): void
    {
        $this->emitToastEvent($message, 'Success');
    }

    public function toastFail(string $message): void
    {
        $this->emitToastEvent($message, 'Failure');
    }

    public function toastWarningInfo(string $message): void
    {
        $this->emitToastEvent($message, 'WarningInfo');
    }

    private function emitToastEvent(string $message, string $type): void
    {
        $this->dispatch('toast-pop', ['type' => $type, 'message' => $message]);
    }
}
