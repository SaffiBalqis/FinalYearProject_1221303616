<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Available Donations') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- View Claimed Donations Button -->
            <div class="mb-6">
                <a href="{{ route('donations.my_claims') }}" 
                   class="inline-block bg-blue-600 text-white font-semibold px-5 py-2 rounded hover:bg-blue-700 transition">
                    View My Claimed Donations
                </a>
            </div>

            <!-- Available Donations List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($donations as $donation)
                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden border hover:shadow-xl transition duration-300">

                        <!-- Image -->
                        @if ($donation->photo_path)
                            <img src="{{ asset('storage/' . $donation->photo_path) }}" 
                                 alt="Donation Image" 
                                 class="w-full h-48 object-cover">
                        @endif

                        <!-- Card Body with extra padding and spacing -->
                        <div class="p-6 flex flex-col justify-between space-y-4">
                            <!-- Title and Donor -->
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800">{{ $donation->title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">👤 Donated by: <strong>{{ $donation->user->name }}</strong></p>
                            </div>

                            <!-- Description and Details -->
                            <div class="space-y-2 text-sm text-gray-700">
                                <!--<p><strong>Description:</strong> {{ $donation->description }}</p>-->

                                @if($donation->allergy_alert)
                                    <p class="text-red-600"><strong>Allergy Alert:</strong> {{ $donation->allergy_alert }}</p>
                                @endif

                                <p class="text-gray-600"><strong>Expiry:</strong> {{ $donation->expiry_date }}</p>
                                <p class="text-gray-600"><strong>Pickup:</strong> {{ $donation->pickup_instruction }}</p>
                            </div>

                            <!-- Timestamp -->
                            <p class="text-xs text-gray-400">
                                Posted on {{ $donation->created_at->format('d M Y, h:i A') }} • {{ $donation->created_at->diffForHumans() }}
                            </p>

                            <a href="{{ route('donations.show', $donation->id) }}"
                                class="w-full text-center block bg-gray-100 text-blue-600 font-semibold py-2 rounded hover:bg-gray-200 transition">
                                See More Details
                            </a>

                            <!-- Claim Button -->
                            <!--<form action="{{ route('donations.claim', $donation->id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                                    Claim This Donation
                                </button>
                            </form>-->
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 text-lg">
                        No donations are currently available. Please check back later.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
