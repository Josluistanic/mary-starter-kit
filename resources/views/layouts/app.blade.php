<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <x-nav sticky full-width>

        <x-slot:brand>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            <div>Laravel</div>
        </x-slot:brand>

        {{-- Right side actions --}}
        <x-slot:actions>
            <x-button label="Logout" icon="o-power" link="/logout" class="btn-ghost btn-sm" responsive
                no-wire-navigate />
        </x-slot:actions>
    </x-nav>

    <x-main with-nav full-width>

        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">
            @if($user = auth()->user())

                <x-list-item :item="$user" no-separator>
                    <x-slot:avatar>
                        <x-avatar placeholder="{{ substr($user->name, 0, 1) }}" alt="My image" class="!w-10" />
                    </x-slot:avatar>
                </x-list-item>
            @endif

            <x-sidebar />
        </x-slot:sidebar>

        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    <x-toast />
</body>

</html>