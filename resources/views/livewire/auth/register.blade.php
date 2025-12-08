<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Layout('components.layouts.guest')] #[Title('Register')] class extends Component {
    //
}; ?>

<div class="md:w-96 mx-auto mt-20">
    <div class="mb-10">
        <x-app-brand />
    </div>

    <x-form wire:submit="register" no-separator>
        <x-input placeholder="Name" wire:model="name" icon="o-user" />
        <x-input placeholder="user@example.com" wire:model="email" icon="o-envelope" />
        <x-input placeholder="Password" wire:model="password" type="password" icon="o-key" />
        <x-input placeholder="Confirm Password" wire:model="password_confirmation" type="password" icon="o-key" />

        <x-slot:actions>
            <x-button label="Already registered?" class="btn-ghost" link="/login" />
            <x-button label="Register" type="submit" icon="o-paper-airplane" class="btn-neutral" spinner="register" />
        </x-slot:actions>
    </x-form>
</div>
