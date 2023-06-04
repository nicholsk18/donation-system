<x-app-layout :header_title="$title">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{--  Possible that needs to be moved to app layout  --}}
    @if (session()->has('flash_notification.success'))
        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {!! session('flash_notification.success') !!}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="flex justify-around my-12 sm:mx-6 lg:mx-8">
        <div class="bg-gray-800 rounded-lg flex flex-col justify-center w-80 h-60 text-white text-center">
            <h2 class="text-3xl text-orange-600 font-extrabold pb-3">YTD</h2>
            <p class="text-2xl">${{ number_format($donations_ytd, 2) }}</p>
        </div>
        <div class="bg-gray-800 rounded-lg flex flex-col justify-center w-80 h-60 text-white text-center">
            <h2 class="text-3xl text-orange-600 font-extrabold pb-3">This month</h2>
            <p class="text-2xl">${{ number_format($donations_month, 2) }}</p>
        </div>
    </div>

    @if( in_array($user->user_type, [ 'Super Admin', 'Admin' ]) )
        {{-- use if you want to adjust text --}}
    @endif

    <x-table :caption="'Latest Donations'" :columns="[ 'User', 'Date', 'Amount' ]" class="w-1/3">
        @foreach($latest_donations as $user)
            <tr>
                <td class="px-4 py-2 border border-gray-700">{{ $user->first_name }} {{ $user->last_name }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ date('j F, Y', strtotime($user->created_at)) }}</td>
                <td class="px-4 py-2 border border-gray-700">${{ number_format($user->amount, 2) }}</td>
            </tr>
        @endforeach
    </x-table>
</x-app-layout>
