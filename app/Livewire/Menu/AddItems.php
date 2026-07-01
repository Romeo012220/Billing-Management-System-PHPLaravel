<?php

namespace App\Livewire\Menu;

use App\Models\MenuItem;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddItems extends Component
{
    use WithFileUploads;

    public $item_code;
    public $name;
    public $category;
    public $description;
    public $price;
    public $is_active = true;
    public $image;

    protected function rules()
    {
        return [
            'item_code' => 'required|string|max:50|unique:menu_items,item_code',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->image->store('menu-items', 'public');

        MenuItem::create([
            'item_code' => $this->item_code,
            'name' => $this->name,
            'category' => $this->category,
            'description' => $this->description,
            'price' => $this->price,
            'is_active' => $this->is_active,
            'image' => $imagePath,
        ]);

        session()->flash('success', 'Menu item added successfully.');

        return redirect()->route('menu-items.list');
    }

    public function resetForm()
    {
        $this->reset([
            'item_code',
            'name',
            'category',
            'description',
            'price',
            'image',
        ]);

        $this->is_active = true;
    }

    public function render()
    {
        return view('livewire.Menu.add-items')
            ->layout('layouts.app');
    }
}