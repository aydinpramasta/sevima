<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-medium text-lg">Bab yang Belum Anda Selesaikan</h3>
                    <div class="my-4 flex flex-wrap justify-center gap-8">
                        @forelse($unfinishedChapters as $plan)
                            @foreach($plan->chapters as $chapter)
                                <a href="{{ route('roadmap.planner.show', $plan) }}"
                                   class="flex flex-col gap-1 justify-center rounded-xl border px-6 py-4 transition duration-300 hover:shadow-md hover:scale-[0.99]">
                                    <table>
                                        <tr>
                                            <td>Topik</td>
                                            <td>:</td>
                                            <td class="pl-3"><b>{{ $plan->topic }}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Bab</td>
                                            <td>:</td>
                                            <td class="pl-3"><b>{{ $chapter->chapter }}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Deadline</td>
                                            <td>:</td>
                                            <td class="pl-3"><b>{{ $chapter->getStartDiff() }}</b></td>
                                        </tr>
                                    </table>
                                </a>
                            @endforeach
                        @empty
                            <h3 class="text-md">Hooray! Anda tidak memiliki Bab yang belum diselesaikan.</h3>
                        @endforelse
                    </div>
                    <div class="">
                        {{ $unfinishedChapters->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
