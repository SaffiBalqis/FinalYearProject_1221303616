<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post a Donation</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('donations.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
                @csrf

                <div class="mb-4">
                    <label class="block font-bold">Upload a Picture</label>
                    <input type="file" name="photo" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Title</label>
                    <input type="text" name="title" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Description</label>
                    <textarea name="description" class="w-full border p-2 rounded" rows="4" required></textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Allergy Alert</label>
                    <input type="text" name="allergy_alert" class="w-full border p-2 rounded">
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Expiry Date</label>
                    <input type="date" name="expiry_date" class="w-full border p-2 rounded" required min="{{ \Carbon\Carbon::now()->toDateString() }}">
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Pickup Instructions (optional)</label>
                    <textarea name="pickup_instruction" class="w-full border p-2 rounded" rows="2"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                        Post!
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
