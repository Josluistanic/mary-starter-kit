<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

new #[Layout('layouts.app')] #[Title('Profile')] class extends Component {

    // Update Profile Information
    #[Rule('required|string|max:255')]
    public string $name = '';

    #[Rule('required|email|max:255')]
    public string $email = '';

    // Update Password
    #[Rule('required|current_password')]
    public string $current_password = '';

    #[Rule('required|min:8|confirmed')]
    public string $password = '';

    public string $password_confirmation = '';

    // Delete Account
    #[Rule('required|current_password')]
    public string $delete_password = '';

    public bool $showDeleteModal = false;

    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateProfile(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        Auth::user()->update($validated);

        $this->dispatch('profile-updated');
        session()->flash('profile_success', 'Profile updated successfully!');
    }

    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ]);

        Auth::user()->update([
            'password' => Hash::make($this->password)
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);

        $this->dispatch('password-updated');
        session()->flash('password_success', 'Password updated successfully!');
    }

    public function deleteAccount(): void
    {
        $this->validate([
            'delete_password' => 'required|current_password',
        ], [
            'delete_password.current_password' => 'The password is incorrect.',
        ]);

        $user = Auth::user();

        Auth::logout();

        $user->delete();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        $this->redirect('/', navigate: true);
    }

    public function openDeleteModal(): void
    {
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;
        $this->reset('delete_password');
        $this->resetErrorBag();
    }
}; ?>

<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-8">Profile Settings</h1>

    {{-- Update Profile Information --}}
    <div class="mb-8">
        <x-card title="Profile Information" subtitle="Update your account's profile information and email address.">
            @if (session('profile_success'))
                <x-alert title="Success!" description="{{ session('profile_success') }}" icon="o-check-circle" class="alert-success mb-4" />
            @endif

            <x-form wire:submit="updateProfile">
                <x-input label="Name" wire:model="name" icon="o-user" />
                <x-input label="Email" wire:model="email" icon="o-envelope" />

                <x-slot:actions>
                    <x-button label="Save" type="submit" icon="o-paper-airplane" class="btn-primary" spinner="updateProfile" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>

    {{-- Update Password --}}
    <div class="mb-8">
        <x-card title="Update Password" subtitle="Ensure your account is using a long, random password to stay secure.">
            @if (session('password_success'))
                <x-alert title="Success!" description="{{ session('password_success') }}" icon="o-check-circle" class="alert-success mb-4" />
            @endif

            <x-form wire:submit="updatePassword">
                <x-password label="Current Password" wire:model="current_password" icon="o-key" right />
                <x-password label="New Password" wire:model="password" icon="o-key" right />
                <x-password label="Confirm Password" wire:model="password_confirmation" icon="o-key" right />

                <x-slot:actions>
                    <x-button label="Update Password" type="submit" icon="o-paper-airplane" class="btn-primary" spinner="updatePassword" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>

    {{-- Delete Account --}}
    <div class="mb-8">
        <x-card title="Delete Account" subtitle="Once your account is deleted, all of its resources and data will be permanently deleted.">
            <x-button label="Delete Account" icon="o-trash" class="btn-error" wire:click="openDeleteModal" />
        </x-card>
    </div>

    {{-- Delete Account Confirmation Modal --}}
    <x-modal wire:model="showDeleteModal" title="Delete Account" subtitle="Are you sure you want to delete your account?">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
        </div>

        <x-form wire:submit="deleteAccount">
            <x-password label="Password" wire:model="delete_password" icon="o-key" right />

            <x-slot:actions>
                <x-button label="Cancel" class="btn-ghost" wire:click="closeDeleteModal" />
                <x-button label="Delete Account" type="submit" icon="o-trash" class="btn-error" spinner="deleteAccount" />
            </x-slot:actions>
        </x-form>
    </x-modal>
</div>
