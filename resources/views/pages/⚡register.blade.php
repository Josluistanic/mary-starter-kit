<?php

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

new #[Layout('layouts.guest')] #[Title('Register')] class extends Component {
    #[Rule('required')]
    public string $name = '';

    #[Rule('required|email|unique:users')]
    public string $email = '';

    #[Rule('required|confirmed')]
    public string $password = '';

    #[Rule('required')]
    public string $password_confirmation = '';

    public function mount()
    {
        // It is logged in
        if (Auth::user()) {
            return redirect('/');
        }
    }

    /**
     * Handle an incoming registration request.
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        $data = $this->validate();

        $user = User::create($data);

        Auth::login($user);
        request()->session()->regenerate();
        return redirect('/');
    }
}; ?>

<div class="md:w-96 mx-auto mt-20">
    <div class="mb-10">
        <x-app-brand />
    </div>

    <x-form wire:submit="store" no-separator>
        <x-input placeholder="Name" wire:model="name" icon="o-user" />
        <x-input placeholder="user@example.com" wire:model="email" icon="o-envelope" />
        <x-password placeholder="Password" wire:model="password" type="password" icon="o-key" right />
        <x-password placeholder="Confirm Password" wire:model="password_confirmation" type="password" icon="o-key"
            right />

        <x-slot:actions>
            <x-button label="Already registered?" class="btn-ghost" link="/login" />
            <x-button label="Register" type="submit" icon="o-paper-airplane" class="btn-neutral" spinner="register" />
        </x-slot:actions>
    </x-form>
</div>