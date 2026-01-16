<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

new #[Layout('layouts.guest')] #[Title('Login')] class extends Component {

    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required')]
    public string $password = '';

    public function mount()
    {
        if (Auth::user()) {
            return redirect('/');
        }
    }

    public function authenticate()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            return redirect()->intended('/');
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }
}; ?>

<div class="md:w-96 mx-auto mt-20">
    <div class="mb-10">
        <x-app-brand />
    </div>

    <x-form wire:submit="authenticate" no-separator>
        <x-input placeholder="user@example.com" wire:model="email" icon="o-envelope" />
        <x-password placeholder="password" wire:model="password" clearable />

        <a href="#" class="text-xs hover:underline hover:underline-offset-2 text-right">Forgot password?</a>
        <x-slot:actions>
            <x-button label="Create an account" class="btn-ghost" link="/register" />
            <x-button label="Login" type="submit" icon="o-paper-airplane" class="btn-neutral" spinner="login" />
        </x-slot:actions>
    </x-form>
</div>