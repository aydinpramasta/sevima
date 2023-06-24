<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Roadmap Plan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('roadmap.planner.update', $planner) }}" class="grid gap-6">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="topic" value="Topik"/>
                            <x-text-input id="topic" name="topic" type="text" class="mt-1 block w-full"
                                          :value="old('topic', $planner->topic)"/>
                            <x-input-error class="mt-2" :messages="$errors->get('topic')"/>
                        </div>

                        <div x-data="chapters()" class="overflow-x-auto">
                            <div class="flex gap-4 justify-between items-center">
                                <x-input-label for="chapters" value="Bab"/>
                                <x-secondary-button @click.prevent="addChapter()">Tambah Bab</x-secondary-button>
                            </div>
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
                                    <th scope="col" class="px-6 py-3"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <template x-for="(chapter, index) in chapters" :key="chapter.id">
                                    <tr class="bg-white border-b">
                                        <input type="hidden" x-bind:name="'chapters[' + index + '][id]'"
                                               x-bind:value="chapter.id"/>
                                        <td class="px-6 py-4">
                                            <x-text-input type="text" x-bind:name="'chapters[' + index + '][chapter]'"
                                                          x-bind:value="chapter.chapter"/>
                                        </td>
                                        <td class="px-6 py-4">
                                            <x-text-input class="w-[100px]" type="number"
                                                          x-bind:value="chapter.planned_hours"
                                                          x-bind:name="'chapters[' + index + '][planned_hours]'"/>
                                            <span class="text-md ml-4">jam</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <x-danger-button @click="deleteChapter(chapter.id)" type="button">Hapus
                                            </x-danger-button>
                                        </td>
                                    </tr>
                                </template>
                                </tbody>
                            </table>

                            <x-input-error class="mt-2" :messages="$errors->get('chapters')"/>
                            @foreach($errors->get('chapters.*') as $error)
                                <x-input-error class="mt-2" :messages="$error"/>
                            @endforeach
                        </div>

                        <div class="flex items-center gap-4 ml-auto">
                            <a href="{{ route('roadmap.planner.show', $planner) }}">
                                <x-secondary-button>Kembali</x-secondary-button>
                            </a>
                            <x-primary-button>Save</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function chapters() {
            return {
                chapters: {!! json_encode(old('chapters', $planner->chapters) ?? []) !!},
                addChapter() {
                    this.chapters.push({
                        id: Date.now(),
                        chapter: '',
                        planned_hours: '',
                    });
                },
                deleteChapter(chapterId) {
                    let position = this.chapters.findIndex(el => el.id === chapterId);
                    this.chapters.splice(position, 1);
                }
            }
        }
    </script>
</x-app-layout>
