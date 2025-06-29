<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Successfully Claimed✅') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @forelse ($donations as $donation)
                <div class="bg-white p-6 rounded shadow mb-6 flex gap-6 items-start border border-gray-200">

                    {{-- Image --}}
                    @if ($donation->photo_path)
                        <img src="{{ asset('storage/' . $donation->photo_path) }}" alt="Donation Image" class="w-40 h-40 object-cover rounded border border-gray-300">
                    @else
                        <div class="w-40 h-40 bg-gray-100 flex items-center justify-center text-gray-400 border border-gray-300 rounded">
                            No Image
                        </div>
                    @endif

                    {{-- Details --}}
                    <div class="flex-1">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $donation->title }}</h3>

                        <p class="text-gray-700 mt-2"><strong>Description:</strong> {{ $donation->description }}</p>

                        @if($donation->allergy_alert)
                            <p class="text-red-600 mt-1"><strong>Allergy Alert:</strong> {{ $donation->allergy_alert }}</p>
                        @endif

                        <p class="text-sm text-gray-600 mt-2"><strong>Expiry Date:</strong> {{ \Carbon\Carbon::parse($donation->expiry_date)->format('d M Y') }}</p>
                        <p class="text-sm text-gray-600"><strong>Pickup Instructions:</strong> {{ $donation->pickup_instruction }}</p>
                        <p class="text-sm text-gray-600 mt-1"><strong>Donor:</strong> {{ $donation->user->name }}</p>
                        <p class="text-sm text-gray-600"><strong>Claimed:</strong> {{ $donation->updated_at->diffForHumans() }}</p>

                        {{-- Expiry Badge --}}
                        @if(\Carbon\Carbon::parse($donation->expiry_date)->isPast())
                            <span class="inline-block mt-2 px-3 py-1 bg-red-200 text-red-800 text-xs font-semibold rounded-full">Past expiry date</span>
                        @else
                            <span class="inline-block mt-2 px-3 py-1 bg-green-200 text-green-800 text-xs font-semibold rounded-full">Safe to consume</span>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-600">You haven’t claimed any donations yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
