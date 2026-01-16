<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

new #[Layout('layouts.guest')] #[Title('Reset Password')] class extends Component {

    public string $token = '';

    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required|min:8|confirmed')]
    public string $password = '';

    #[Rule('required')]
    public string $password_confirmation = '';

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->email = request()->query('email', '');
    }

    public function resetPassword(): void
    {
        $this->validate();

        $status = Password::reset(
            [
                'token' => $this->token,
                'email' => $this->email,
                'password' => $this->password,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('status', 'Your password has been reset!');
            $this->redirect('/login', navigate: true);
        } else {
            $this->addError('email', 'This password reset token is invalid or has expired.');
        }
    }
}; ?>

<div class="md:w-96 mx-auto mt-20">
    <div class="mb-10">
        <x-app-brand />
    </div>

    <x-form wire:submit="resetPassword" no-separator>
        <x-input placeholder="user@example.com" wire:model="email" icon="o-envelope" />
        <x-password placeholder="New Password" wire:model="password" icon="o-key" right />
        <x-password placeholder="Confirm Password" wire:model="password_confirmation" icon="o-key" right />

        <x-slot:actions>
            <x-button label="Back to login" class="btn-ghost" link="/login" />
            <x-button label="Reset Password" type="submit" icon="o-paper-airplane" class="btn-neutral" spinner="resetPassword" />
        </x-slot:actions>
    </x-form>
</div>
