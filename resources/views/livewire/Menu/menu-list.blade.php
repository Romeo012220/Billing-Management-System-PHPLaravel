<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Menu Items</h1>

            <a href="{{ route('menu-items.add') }}"
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Add Menu Item
            </a>
        </div>

        @if (session()->has('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Saved Menu Items</h2>

                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Search menu item..."
                    class="border rounded px-3 py-2 w-64"
                >
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="border px-3 py-2">Item Code</th>
                            <th class="border px-3 py-2">Item Name</th>
                            <th class="border px-3 py-2">Category</th>
                            <th class="border px-3 py-2">Description</th>
                            <th class="border px-3 py-2">Price</th>
                            <th class="border px-3 py-2">Status</th>
                            <th class="border px-3 py-2">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($menuItems as $item)
                            <tr>
                                <td class="border px-3 py-2">
                                    {{ $item->item_code }}
                                </td>

                                <td class="border px-3 py-2 font-medium">
                                    {{ $item->name }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $item->category }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $item->description ?? 'No description' }}
                                </td>

                                <td class="border px-3 py-2">
                                    ₱{{ number_format($item->price, 2) }}
                                </td>

                                <td class="border px-3 py-2">
                                    @if ($item->is_active)
                                        <span class="text-green-600 font-semibold">Active</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Inactive</span>
                                    @endif
                                </td>

                                <td class="border px-3 py-2">
                                    <div class="flex gap-2">
                                        <a
                                            href="{{ route('menu-items.edit', $item->id) }}"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"
                                        >
                                            Edit
                                        </a>

                                        @if($item->is_active)
                                            <button
                                                wire:click="toggleStatus({{ $item->id }})"
                                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600"
                                            >
                                                Disable
                                            </button>
                                        @else
                                            <button
                                                wire:click="toggleStatus({{ $item->id }})"
                                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600"
                                            >
                                                Enable
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="border px-3 py-4 text-center text-gray-500">
                                    No menu items saved yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>