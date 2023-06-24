<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Roadmap Plan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($message = session('success'))
                        <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                            <span class="font-medium">Success!</span> {{ $message }}
                        </div>
                    @endif

                    <div class="grid gap-6">
                        <div>
                            <x-input-label for="topic" value="Topik"/>
                            <x-text-input id="topic" name="topic" type="text" class="mt-1 block w-full"
                                          :value="$planner->topic" disabled/>
                        </div>

                        <div class="overflow-x-auto">
                            <x-input-label for="chapters" value="Bab"/>
                            <table id="chapters"
                                   class="mt-2 w-full text-sm whitespace-nowrap text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Nama Bab') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Alokasi Waktu') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Waktu Mulai') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Waktu Selesai') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($planner->chapters as $chapter)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4">
                                            <x-text-input type="text"
                                                          :value="$chapter->chapter" disabled/>
                                        </td>
                                        <td class="px-6 py-4">
                                            <x-text-input class="w-[100px]" type="number"
                                                          :value="$chapter->planned_hours" disabled/>
                                            <span class="text-md ml-4">jam</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <x-text-input
                                                :value="$chapter->start_at?->timezone('Asia/Jakarta')->locale('id')->isoFormat('H:mm D MMMM Y')"
                                                disabled/>
                                        </td>
                                        <td class="px-6 py-4">
                                            <x-text-input
                                                :value="$chapter->end_at?->timezone('Asia/Jakarta')->locale('id')->isoFormat('H:mm D MMMM Y')"
                                                disabled/>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('roadmap.chapter', $chapter) }}"
                                                  onsubmit="return confirm('Apakah anda yakin?')">
                                                @csrf
                                                @method('put')
                                                @if($chapter->isNotStarted())
                                                    <x-primary-button>Mulai</x-primary-button>
                                                @elseif($chapter->isNotEnded())
                                                    <x-secondary-button type="submit">Selesai</x-secondary-button>
                                                @else
                                                    <span>Bab ini telah anda selesaikan.</span>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <x-input-error class="mt-2" :messages="$errors->get('chapters')"/>
                        </div>

                        <div class="flex items-center gap-4 ml-auto">
                            <a href="{{ route('roadmap.planner.index') }}">
                                <x-secondary-button>Kembali</x-secondary-button>
                            </a>
                            <a href="{{ route('roadmap.planner.edit', $planner) }}">
                                <x-primary-button>Edit</x-primary-button>
                            </a>
                            <form action="{{ route('roadmap.planner.destroy', $planner) }}" method="post"
                                  onsubmit="return confirm('Apakah Anda yakin?')">
                                @csrf
                                @method('delete')
                                <x-danger-button>Hapus</x-danger-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
