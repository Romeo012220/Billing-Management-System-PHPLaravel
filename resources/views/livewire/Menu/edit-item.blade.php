<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">
                Edit Menu Item
            </h1>

            <a href="{{ route('menu-items.list') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Back
            </a>
        </div>

        @if (session()->has('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200">

            <div class="border-b px-6 py-4">
                <h2 class="text-xl font-semibold">
                    Update Menu Item
                </h2>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Menu Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Menu Name
                        </label>

                        <input
                            type="text"
                            wire:model="name"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2"
                        >

                        @error('name')
                            <span class="text-red-500 text-sm">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Price
                        </label>

                        <div class="relative">
                            <span class="absolute left-3 top-2.5 text-gray-500">
                                ₱
                            </span>

                            <input
                                type="number"
                                step="0.01"
                                wire:model="price"
                                class="w-full pl-8 rounded-lg border border-gray-300 px-4 py-2"
                            >
                        </div>

                        @error('price')
                            <span class="text-red-500 text-sm">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>

                        <textarea
                            wire:model="description"
                            rows="4"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2"
                        ></textarea>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Status
                        </label>

                        <select
                            wire:model="is_active"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2"
                        >
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="mt-6 flex justify-end gap-3">

                    <a
                        href="{{ route('menu-items.list') }}"
                        class="px-5 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600"
                    >
                        Cancel
                    </a>

                    <button
                        wire:click="update"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                    >
                        Update Item
                    </button>

                </div>

            </div>

        </div>

    </div>
</div>