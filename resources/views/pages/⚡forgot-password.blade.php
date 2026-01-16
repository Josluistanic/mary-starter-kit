<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Password;

new #[Layout('layouts.guest')] #[Title('Forgot Password')] class extends Component {

    #[Rule('required|email')]
    public string $email = '';

    public string $status = '';

    public function sendResetLink(): void
    {
        $this->validate();

        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            $this->status = 'We have emailed your password reset link!';
            $this->reset('email');
        } else {
            $this->addError('email', 'We could not find a user with that email address.');
        }
    }
}; ?>

<div class="md:w-96 mx-auto mt-20">
    <div class="mb-10">
        <x-app-brand />
    </div>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
    </div>

    @if ($status)
        <x-alert title="Success!" description="{{ $status }}" icon="o-check-circle" class="alert-success mb-4" />
    @endif

    <x-form wire:submit="sendResetLink" no-separator>
        <x-input placeholder="user@example.com" wire:model="email" icon="o-envelope" />

        <x-slot:actions>
            <x-button label="Back to login" class="btn-ghost" link="/login" />
            <x-button label="Email Password Reset Link" type="submit" icon="o-paper-airplane" class="btn-neutral" spinner="sendResetLink" />
        </x-slot:actions>
    </x-form>
</div>
