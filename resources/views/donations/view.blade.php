<x-app-layout :header_title="$title">
    <x-nav-header>{{ __("Donations") }}</x-nav-header>

    <x-table :caption="'Donations'" :columns="[ 'User', 'Date', 'Amount', 'Action' ]">
        @foreach($donations as $donation)
            <tr>
                <td class="px-4 py-2 border border-gray-700">{{ $donation->first_name }} {{ $donation->last_name }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ date('j F, Y', strtotime($donation->created_at)) }}</td>
                <td class="px-4 py-2 border border-gray-700">${{ number_format($donation->amount, 2) }}</td>
                <td class="px-4 py-2 border border-gray-700"></td>
            </tr>
        @endforeach
    </x-table>
</x-app-layout>
