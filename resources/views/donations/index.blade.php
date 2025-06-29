<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Donations') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <!-- Filter Dropdown -->
    <div class="mb-6">
        <form action="{{ route('donations.index') }}" method="GET" class="flex items-center space-x-4">
            <label for="claim_status" class="text-gray-700 text-sm">Filter by Claim Status:</label>
        
        <select name="claim_status" id="claim_status"
            class="px-3 pr-8 py-2 text-sm border border-gray-300 rounded-md w-56">
            <option value="">All Donations</option>
            <option value="claimed" {{ request('claim_status') == 'claimed' ? 'selected' : '' }}>Claimed</option>
            <option value="not_claimed" {{ request('claim_status') == 'not_claimed' ? 'selected' : '' }}>Not Claimed</option>
        </select>

        <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Filter
        </button>
        </form>
    </div>

            <!-- Create Donation Button -->
            <div class="mb-6">
                <a href="{{ route('donations.create') }}" 
                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    + Create New Donation
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @forelse ($donations as $donation)
                <div class="bg-white p-6 rounded-xl shadow-md mb-6 border border-gray-300 hover:shadow-lg transition duration-300">

                    <!-- Top Row: Posted At + Edit/Delete Buttons -->
                    <div class="flex justify-between items-center mb-4">
                        Posted by: {{ $donation->user->name }}     
                        @if ($donation->created_at)
                            <p class="text-sm text-gray-500">
                                <strong>Posted:</strong> {{ $donation->created_at->diffForHumans() }}
                            </p>
                        @endif

                        <div class="flex items-center space-x-4 text-lg font-medium">
                            <!-- Edit Button -->
                            <a href="{{ route('donations.edit', $donation->id) }}" class="text-blue-600 hover:text-blue-800">
                                Edit
                            </a>

                            <!-- Divider -->
                            <span class="text-gray-400">|</span>

                            <!-- Delete Button -->
                            <form action="{{ route('donations.destroy', $donation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this donation?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-7 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7H5M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2m-6 0h6m2 0v12a2 2 0 01-2 2H8a2 2 0 01-2-2V7h12z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                        <!-- Image Section -->
                        @if ($donation->photo_path)
                            <div class="border-4 border-gray-300 p-2 rounded-lg">
                                <img src="{{ asset('storage/' . $donation->photo_path) }}" alt="Donation Image" class="w-48 h-48 object-cover rounded-md">
                            </div>
                        @endif

                        <!-- Info Section -->
                        <div class="flex-1">
                            <h3 class="text-2xl font-semibold text-gray-800 mb-2">{{ $donation->title }}</h3>

                            @if($donation->description)
                                <p class="text-gray-700 mb-2"><strong>Description:</strong> {{ $donation->description }}</p>
                            @endif

                            @if($donation->allergy_alert)
                                <p class="text-red-600 font-medium mb-2"><strong>Allergy Alert:</strong> {{ $donation->allergy_alert }}</p>
                            @endif

                            <p class="text-base text-gray-600 mb-1"><strong>Expiry Date:</strong> {{ $donation->expiry_date }}</p>
                            <p class="text-base text-gray-600 mb-1"><strong>Pickup Instructions:</strong> {{ $donation->pickup_instruction }}</p>

                            {{-- Claim Status --}}
                            @if ($donation->claimed_by)
                                <p class="mt-4 text-green-600 font-semibold">
                                    🎉 Claimed by: {{ \App\Models\User::find($donation->claimed_by)?->name ?? 'Unknown user' }}
                                </p>
                            @else
                                <p class="mt-4 text-yellow-600 font-semibold">
                                    ⏳ Not claimed yet
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">You haven’t posted any donations yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
