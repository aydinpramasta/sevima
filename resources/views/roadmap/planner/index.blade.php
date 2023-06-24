<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Roadmap Planner
        </h2>
        <p class="text-gray-600 leading-tight">
            Rencanakan alokasi waktu untuk belajar roadmap.
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-8 flex justify-between gap-4">
                        <h2 class="font-semibold text-lg text-gray-800">Roadmap Anda</h2>
                        <a href="{{ route('roadmap.planner.create') }}">
                            <x-primary-button type="button">Buat Plan</x-primary-button>
                        </a>
                    </div>

                    <div class="flex flex-wrap justify-center gap-8">
                        @foreach($plans as $plan)
                            <a href="{{ route('roadmap.planner.edit') }}"
                               class="flex gap-4 items-center rounded-xl border px-6 py-4 transition duration-300 hover:shadow-md hover:scale-[0.99]">
                                <span>{{ $plan->topic }}</span>
                                <svg class="w-[20px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25">
                                    <path style="fill:#232326"
                                          d="m17.5 5.999-.707.707 5.293 5.293H1v1h21.086l-5.294 5.295.707.707L24 12.499l-6.5-6.5z"
                                          data-name="Right"/>
                                </svg>
                            </a>
                        @endforeach
                    </div>

                    <div class="px-5 py-5 bg-white">
                        {{ $plans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
