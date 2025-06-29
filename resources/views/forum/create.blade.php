<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Discussion</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('forum-posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label class="block font-bold">Title</label>
                    <input type="text" name="title" placeholder="Enter post title" 
                           class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label class="block font-bold">Category</label>
                    <select name="category" required 
                            class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option disabled selected>Select a category</option>
                        <option value="Spreading the Word">Spreading the Word</option>
                        <option value="Zero Waste">Zero Waste</option>
                        <option value="Recipes">Recipes</option>
                        <option value="Others">Others</option>
                    </select>
                </div>

                <!-- Content -->
                <div class="mb-4">
                    <label class="block font-bold">Content</label>
                    <textarea name="content" rows="5" placeholder="Write your post content here..." 
                              class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <label class="block font-bold">Upload Image (Optional)</label>
                    <input type="file" name="image" 
                           class="w-full border p-2 rounded file:mr-4 file:py-2 file:px-4
                                  file:border-0 file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <!-- Guidelines Checkbox -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="guidelines" name="agreed_to_guidelines" type="checkbox" required
                                   class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="guidelines" class="font-medium text-gray-700">
                                I agree to the community guidelines before posting
                            </label>
                            <p class="text-gray-500 mt-1">
                                By checking this box, I confirm I have read and will follow the forum rules.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        Post Discussion 
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>