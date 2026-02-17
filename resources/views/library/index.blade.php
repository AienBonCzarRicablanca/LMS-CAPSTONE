<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Digital Reading Library') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <form method="GET" action="{{ route('library.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <x-input-label value="Language" />
                            <select name="language" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All</option>
                                <option value="English" @selected(request('language') === 'English')>English</option>
                                <option value="Tagalog" @selected(request('language') === 'Tagalog')>Tagalog</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label value="Difficulty" />
                            <select name="difficulty" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All</option>
                                <option value="Beginner" @selected(request('difficulty') === 'Beginner')>Beginner</option>
                                <option value="Intermediate" @selected(request('difficulty') === 'Intermediate')>Intermediate</option>
                                <option value="Advanced" @selected(request('difficulty') === 'Advanced')>Advanced</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label value="Category" />
                            <select name="category" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected((string)request('category') === (string)$cat->id)>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end">
                            <x-primary-button>Filter</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($items as $item)
                    <a href="{{ route('library.show', $item) }}" class="bg-white shadow-sm sm:rounded-lg overflow-hidden p-6 hover:bg-gray-50">
                        <div class="font-semibold text-gray-900">{{ $item->title }}</div>
                        <div class="mt-1 text-sm text-gray-500">{{ $item->language }} • {{ $item->difficulty }}</div>
                        <div class="mt-1 text-sm text-gray-500">{{ $item->category?->name ?? 'Uncategorized' }}</div>
                    </a>
                @empty
                    <div class="text-gray-500">No library items found.</div>
                @endforelse
            </div>

            <div>{{ $items->links() }}</div>
        </div>
    </div>
</x-app-layout>
