<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $item->title }}</h2>
            <div class="text-sm text-gray-500">{{ $item->language }} • {{ $item->difficulty }} • {{ $item->category?->name ?? 'Uncategorized' }}</div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="prose max-w-none">
                        {!! nl2br(e($item->text_content ?? '')) !!}
                    </div>

                    <div class="mt-6 border-t pt-4">
                        @if($item->audio_path)
                            <div class="text-sm text-gray-600">Audio</div>
                            <audio class="mt-2 w-full" controls src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($item->audio_path) }}"></audio>
                            <div class="text-xs text-gray-500 mt-2">Audio is optional (future AI/audio integration can replace this).</div>
                        @else
                            <div class="flex items-center gap-3">
                                <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md text-xs uppercase tracking-widest" disabled>
                                    Audio Playback (TTS placeholder)
                                </button>
                                <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md text-xs uppercase tracking-widest" disabled>
                                    Read Aloud (record placeholder)
                                </button>
                            </div>
                            <div class="text-xs text-gray-500 mt-2">Placeholders only for now (future AI/audio integration).</div>
                        @endif
                    </div>
                </div>
            </div>

            @if(session('status'))
                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                    <div class="p-4 text-green-700">{{ session('status') }}</div>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="font-semibold text-gray-900">Comprehension Activity</h3>
                    <p class="text-sm text-gray-500 mt-1">This is a starter scaffold. You can replace these with real activity builders later.</p>

                    <form method="POST" action="{{ route('library.activities.store', $item) }}" class="mt-4 space-y-4">
                        @csrf
                        <div>
                            <x-input-label value="Activity Type" />
                            <select name="type" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="MCQ">Multiple Choice</option>
                                <option value="MATCHING">Matching</option>
                                <option value="SHORT">Short Questions</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Your Answer (placeholder)" />
                            <textarea name="answers[freeform]" rows="4" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Type answers here..."></textarea>
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>Submit</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
