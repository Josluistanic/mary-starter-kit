<x-menu activate-by-route>
    <x-menu-item title="Home" icon="o-home" link="/" />
    <x-menu-sub title="Settings" icon="o-cog-6-tooth">
        <x-menu-item title="Profile" icon="o-user-circle" link="{{ route('profile') }}" />
    </x-menu-sub>
</x-menu>