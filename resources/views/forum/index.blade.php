<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Community Space</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Create Post Button and Filter Form -->
            <div class="mb-4 flex flex-wrap items-center justify-between gap-4">
                <a href="{{ route('forum-posts.create') }}" 
                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    + Create New Discussion
                </a>

                <!-- Filter Form -->
                <form method="GET" action="{{ route('forum-posts.index') }}" class="flex items-center space-x-2 ml-4">
                    <label for="category" class="sr-only">Filter by Category</label>
                    <select name="category" id="category" class="border border-gray-300 rounded px-3 py-1">
                        <option value="">All Categories</option>
                        <option value="Spreading the Word" {{ request('category') == 'Spreading the Word' ? 'selected' : '' }}>Spreading the Word</option>
                        <option value="Zero Waste" {{ request('category') == 'Zero Waste' ? 'selected' : '' }}>Zero Waste</option>
                        <option value="Recipes" {{ request('category') == 'Recipes' ? 'selected' : '' }}>Recipes</option>
                        <option value="Others" {{ request('category') == 'Others' ? 'selected' : '' }}>Others</option>
                    </select>
                    <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Filter
                    </button>
                </form>
            </div>

            @if($posts->count() == 0)
                <p class="text-gray-600">No forum posts yet. Be the first to contribute!</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($posts as $post)
                        <div class="relative bg-white shadow p-6 rounded-lg border border-gray-200 max-w-md min-h-[380px] flex flex-col
                                    before:content-[''] before:absolute before:-bottom-3 before:left-6 before:w-5 before:h-5 before:bg-white before:border before:border-gray-200 before:rounded-tl-lg before:rotate-45 before:z-0">

                            <div class="flex justify-between items-start mb-2 relative z-10">
                                <div class="mb-2">
                                    <span class="text-sm px-2 py-1 bg-gray-200 text-gray-700 rounded">{{ $post->category }}</span>
                                </div>

                                @if(auth()->id() === $post->user_id)
                                    <div class="flex space-x-4 text-lg font-medium">
                                        <a href="{{ route('forum-posts.edit', $post->id) }}" class="text-blue-600 hover:text-blue-800 px-3 py-1 transition">Edit</a>
                                        <span class="text-gray-400">|</span>
                                        <form action="{{ route('forum-posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 px-3 py-1 transition" aria-label="Delete Post">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 inline-block">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M19 7H5M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2m-6 0h6m2 0v12a2 2 0 01-2 2H8a2 2 0 01-2-2V7h12z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mb-2 relative z-10 break-words">{{ $post->title }}</h3>

                            <p class="text-gray-700 mb-3 text-justify pr-2 relative z-10 flex-grow break-words max-h-28 overflow-auto">
                                {{ $post->content }}
                            </p>

                            @if($post->image_path)
                                <div class="mb-3 relative z-10 flex justify-center overflow-hidden w-36 h-36 rounded">
                                    <img src="{{ asset('storage/' . $post->image_path) }}" 
                                         alt="Forum Image" 
                                         class="object-cover w-full h-full flex-shrink-0 rounded">
                                </div>
                            @endif

                            <p class="text-sm text-gray-500 relative z-10 mt-auto">
                                👤 Posted by: {{ $post->user->name }} 
                                @if($post->created_at)
                                    • {{ $post->created_at->diffForHumans() }}
                                @endif
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Pagination -->
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
