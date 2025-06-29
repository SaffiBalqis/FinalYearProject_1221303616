<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Donation Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 bg-white p-6 rounded-2xl shadow">
            @if ($donation->photo_path)
                <img src="{{ asset('storage/' . $donation->photo_path) }}" class="w-full h-64 object-cover mb-6 rounded" alt="Donation Image">
            @endif

            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $donation->title }}</h3>
            <p class="text-gray-600 mb-2"><strong>Donated by:</strong> {{ $donation->user->name }}</p>
            <p class="text-gray-700 mb-4">{{ $donation->description }}</p>

            @if($donation->allergy_alert)
                <p class="text-red-600 mb-2"><strong>Allergy Alert:</strong> {{ $donation->allergy_alert }}</p>
            @endif

            <p class="text-gray-600"><strong>Expiry:</strong> {{ $donation->expiry_date }}</p>
            <p class="text-gray-600"><strong>Pickup Instructions:</strong> {{ $donation->pickup_instruction }}</p>

            <form action="{{ route('donations.claim', $donation->id) }}" method="POST">
                @csrf
                <button type="submit" 
                        class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                    Claim This Donation
                </button>
            </form>
        </div>
    </div>
</x-app-layout>