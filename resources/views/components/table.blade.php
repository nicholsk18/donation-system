@props(['caption', 'columns'])

<div class="my-12 sm:mx-6 lg:mx-8 text-white">
    <table class="w-full border border-slate-500">
        <caption class="table-caption text-left px-4 py-2 border border-gray-700 font-extrabold text-2xl bg-gray-800">
            {{ $caption ?? '' }}
        </caption>
        <thead>
        <tr class="text-left">
            @foreach((Array) $columns as $column)
                <th class="px-4 py-2 border border-gray-700 bg-gray-800 text-xl w-1/3">{{ $column }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
