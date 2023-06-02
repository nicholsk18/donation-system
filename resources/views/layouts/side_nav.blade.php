<div class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 min-h-screen h-full">
    <!-- Logo -->
    <div class="shrink-0 flex justify-center items-center w-full h-28 border-b border-gray-700">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block w-auto fill-current text-gray-800 dark:text-gray-200" />
        </a>
    </div>

    <div class="flex flex-col mt-10">
        <!-- Navigation Links -->
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>

        <x-nav-link :href="route('donations.view')" :active="request()->routeIs('donations.view')">
            @if(isset(request()->user()->user_type) && request()->user()->user_type !== 'User')
                {{ __('Org Donations') }}
            @else
                {{ __('User Donations') }}
            @endif
        </x-nav-link>

        @if(isset(request()->user()->user_type) && request()->user()->user_type !== 'User')
            <x-nav-link :href="route('organization.users')" :active="request()->routeIs('organization.users')">
                {{ __('Organization Users') }}
            </x-nav-link>
        @endif
    </div>
</div>
