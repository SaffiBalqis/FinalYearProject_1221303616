<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Donation') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <!-- Error Display -->
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('donations.update', $donation->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Title*</label>
                    <input type="text" name="title" value="{{ old('title', $donation->title) }}" 
                           class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Description*</label>
                    <textarea name="description" rows="4" 
                              class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>{{ old('description', $donation->description) }}</textarea>
                </div>

                <!-- Allergy Alert -->
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Allergy Alert</label>
                    <input type="text" name="allergy_alert" value="{{ old('allergy_alert', $donation->allergy_alert) }}" 
                           class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <!-- Expiry Date -->
            <div class="mb-4">
             <label class="block font-medium text-gray-700">Expiry Date*</label>
                <input type="date" name="expiry_date" 
                 value="{{ old('expiry_date', $donation->expiry_date instanceof \Carbon\Carbon ? $donation->expiry_date->format('Y-m-d') : $donation->expiry_date) }}" 
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
            </div>

                <!-- Pickup Instructions -->
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Pickup Instructions</label>
                    <textarea name="pickup_instruction" rows="3" 
                              class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('pickup_instruction', $donation->pickup_instruction) }}</textarea>
                </div>

                <!-- Photo -->
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Photo</label>
                    <input type="file" name="photo" 
                           class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @if ($donation->photo_path)
                        <div class="mt-4">
                            <p class="text-sm text-gray-500">Current Photo:</p>
                            <img src="{{ asset('storage/' . $donation->photo_path) }}" alt="Current donation photo" class="mt-2 h-40 rounded-md border">
                        </div>
                    @endif
                </div>

            <!-- Submit Button -->
        <div class="flex flex-col sm:flex-row sm:justify-end sm:items-center gap-3 mt-5">
            <a href="{{ route('donations.index') }}" class="text-gray-600 hover:text-black-900">
             Cancel
            </a>

             <button type="submit" 
                class="px-6 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                    Update Donation
             </button>
        </div>

    </div>
</x-app-layout>