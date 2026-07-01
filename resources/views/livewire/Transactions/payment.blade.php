<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Product Payment</h1>
            <p class="text-sm text-gray-500">Search items, add to cart, and process payment.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT: ITEM SEARCH --}}
            <div class="lg:col-span-2 bg-white rounded-xl shadow p-5">

                <div class="flex flex-col md:flex-row md:items-end gap-3">
                    <div class="w-full md:w-48">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Category
                        </label>

                        <select
                            wire:model.live="categoryFilter"
                            class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500"
                        >
                            <option value="">All Categories</option>
                            <option value="Pizza">Pizza</option>
                            <option value="Add-ons">Add-ons</option>
                            <option value="Drinks">Drinks</option>
                            <option value="Dessert">Dessert</option>
                        </select>
                    </div>

                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Search Item
                        </label>

                        <input
                            type="text"
                            wire:model.live="search"
                            placeholder="Search by item name, code, or category..."
                            class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500"
                        >
                    </div>
                </div>

                <div class="mt-5 max-h-[650px] overflow-y-auto pr-2">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                    @forelse($items as $item)
                     <div class="border rounded-xl p-4 hover:shadow-md transition" wire:key="product-{{ $item->id }}">

    @if($item->image)
        <img
            src="{{ Storage::url($item->image) }}"
            alt="{{ $item->name }}"
            class="w-full h-40 object-cover rounded-lg mb-4 border"
        >
    @else
        <div class="w-full h-40 bg-gray-200 rounded-lg mb-4 flex items-center justify-center text-gray-400">
            No Image
        </div>
    @endif

    <h3 class="font-bold text-gray-800">
        {{ $item->name }}
    </h3>

                            <p class="text-sm text-gray-500">
                                Code: {{ $item->item_code }}
                            </p>

                            <p class="text-sm text-gray-500">
                                Category: {{ $item->category }}
                            </p>

                            <p class="mt-3 text-lg font-bold text-red-600">
                                ₱{{ number_format($item->price, 2) }}
                            </p>

                            <button
                                wire:click="addToCart({{ $item->id }})"
                                class="mt-4 w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition"
                            >
                                Add to Cart
                            </button>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500 py-10">
                            No items found.
                        </div>
                    @endforelse
                </div>
            </div>
            </div>

          {{-- RIGHT: CART / PAYMENT --}}
<div class="bg-white rounded-xl shadow p-5 self-start">
    <h2 class="text-lg font-bold text-gray-800 mb-4">Order Summary</h2>

    @php
        $icons = [
            'Pizza' => '🍕',
            'Add-ons' => '➕',
            'Drinks' => '🥤',
            'Dessert' => '🍰',
        ];

        $groupedCart = collect($cart)
            ->map(function ($item, $index) {
                $item['_index'] = $index;
                return $item;
            })
            ->groupBy('category');
    @endphp

    <div class="space-y-3 max-h-80 overflow-y-auto">
        @if(count($cart))
            @foreach($groupedCart as $category => $items)
                <div class="mb-5" wire:key="category-{{ $category }}">
                    <div class="flex items-center gap-2 mb-3 pb-2 border-b">
                        <span class="text-lg">{{ $icons[$category] ?? '📦' }}</span>

                        <h3 class="font-bold uppercase text-gray-700 tracking-wide">
                            {{ $category }}
                        </h3>
                    </div>

                    @foreach($items as $cartItem)
                        <div
                            class="flex items-start justify-between gap-3 py-2 border-b"
                            wire:key="cart-item-{{ $cartItem['_index'] }}-{{ $cartItem['id'] }}"
                        >
                            <div class="flex gap-3">
                                @if(!empty($cartItem['image']))
                                    <img
                                        src="{{ Storage::url($cartItem['image']) }}"
                                        alt="{{ $cartItem['name'] }}"
                                        class="w-12 h-12 object-cover rounded-lg border"
                                    >
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg border flex items-center justify-center text-xs text-gray-400">
                                        N/A
                                    </div>
                                @endif

                                <div>
                                    <h4 class="font-semibold text-gray-800">
                                        {{ $cartItem['name'] }}
                                    </h4>

                                    <p class="text-sm text-gray-500">
                                        ₱{{ number_format($cartItem['price'], 2) }}
                                    </p>

                                    <div class="flex items-center gap-2 mt-2">
                                        <button
                                            wire:click="decreaseQty({{ $cartItem['_index'] }})"
                                            class="px-2 py-1 bg-gray-200 rounded"
                                        >
                                            -
                                        </button>

                                        <span class="font-semibold">
                                            {{ $cartItem['quantity'] }}
                                        </span>

                                        <button
                                            wire:click="increaseQty({{ $cartItem['_index'] }})"
                                            class="px-2 py-1 bg-gray-200 rounded"
                                        >
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="font-bold">
                                    ₱{{ number_format($cartItem['price'] * $cartItem['quantity'], 2) }}
                                </div>

                                <button
                                    wire:click="removeItem({{ $cartItem['_index'] }})"
                                    class="text-xs text-red-600 hover:underline mt-2"
                                >
                                    Remove
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <p class="text-center text-gray-500 py-10">
                Cart is empty.
            </p>
        @endif
    </div>

    <div class="border-t mt-5 pt-5 space-y-3">
        <div class="flex justify-between text-gray-700">
            <span>Subtotal</span>
            <span>₱{{ number_format($subtotal, 2) }}</span>
        </div>

        <div class="flex justify-between text-xl font-bold text-gray-900">
            <span>Total</span>
            <span>₱{{ number_format($total, 2) }}</span>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Cash Received
            </label>

            <input
                type="number"
                wire:model.live="cashReceived"
                placeholder="Enter amount"
                class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500"
            >
        </div>

        <div class="flex justify-between text-lg font-bold">
            <span>Change</span>
            <span class="text-green-600">
                ₱{{ number_format($change, 2) }}
            </span>
        </div>

        <button
            wire:click="processPayment"
            class="w-full bg-green-600 text-white py-3 rounded-lg font-bold hover:bg-green-700 transition disabled:bg-gray-400"
            @disabled(empty($cart) || $cashReceived < $total)
        >
            Pay Now
        </button>

        <button
            wire:click="clearCart"
            class="w-full bg-gray-200 text-gray-700 py-2 rounded-lg hover:bg-gray-300 transition"
        >
            Clear Cart
        </button>
    </div>
</div>

        </div>
    </div>
</div>