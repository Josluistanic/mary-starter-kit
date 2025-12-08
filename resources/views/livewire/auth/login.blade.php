<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Layout('components.layouts.guest')] #[Title('Login')] class extends Component {
    //
}; ?>

<div class="md:w-96 mx-auto mt-20">
    <div class="mb-10">
        <x-app-brand />
    </div>

    <x-form wire:submit="login" no-separator>
        <x-input placeholder="user@example.com" wire:model="email" icon="o-envelope" />
        <x-password placeholder="password" wire:model="password" clearable />

        <a href="#" class="text-xs hover:underline hover:underline-offset-2 text-right">Forgot password?</a>
        <x-slot:actions>
            <x-button label="Create an account" class="btn-ghost" link="/register" />
            <x-button label="Login" type="submit" icon="o-paper-airplane" class="btn-neutral" spinner="login" />
        </x-slot:actions>
    </x-form>
</div>
