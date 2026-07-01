<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="border-b px-6 py-4">
      <h2 class="text-xl font-semibold mb-4">
    Add Menu Item
</h2>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <!-- Item Code -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Item Code
                </label>

                <input
                    type="text"
                    wire:model="item_code"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Ex. PIZ001"
                >
            </div>

            <!-- Item Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Item Name
                </label>

                <input
                    type="text"
                    wire:model="name"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter item name"
                >
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Category
                </label>

                <select
                    wire:model="category"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Select Category</option>
                    <option>Pizza</option>
                    <option>Add-ons</option>
                    <option>Drinks</option>
                    <option>Dessert</option>
                </select>
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Price
                </label>

                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-gray-500">₱</span>

                    <input
                        type="number"
                        step="0.01"
                        wire:model="price"
                        class="w-full pl-8 rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500"
                        placeholder="0.00"
                    >
                </div>
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                </label>

                <textarea
                    wire:model="description"
                    rows="4"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500"
                    placeholder="Item description"
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
    <button
        wire:click="resetForm"
        type="button"
        class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300"
    >
        Clear
    </button>

    <a
        href="{{ route('menu-items.list') }}"
        class="px-5 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600"
    >
        Back
    </a>

    <button
        wire:click="save"
        class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
    >
        Save Item
    </button>
</div>
    </div>
</div>