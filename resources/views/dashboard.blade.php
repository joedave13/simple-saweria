<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div> --}}

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6 p-6">
                <label for="profile-url" class="block text-sm font-medium text-gray-700">Profile URL</label>
                <div class="flex mt-1">
                    <input type="text" id="profile-url" value="{{ url('user/' . Auth::user()->username) }}"
                        class="form-input block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        readonly>
                    <button onclick="copyProfileUrl()"
                        class="ml-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-500 focus:ring-opacity-50">Copy</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function copyProfileUrl() {
                const profileUrl = document.getElementById('profile-url');
                profileUrl.select();
                profileUrl.setSelectionRange(0, 99999);

                if (window.isSecureContext && navigator.clipboard) {
                    navigator.clipboard.writeText(profileUrl.value);
                } else {
                    document.execCommand('copy');
                }

                alert('Copied to clipboard.');
            }
        </script>
    @endpush
</x-app-layout>
