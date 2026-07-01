<?php

namespace App\Livewire\Menu;

use Livewire\Component;
use App\Models\MenuItem;

class EditItem extends Component
{
    public $menuItem;

    public $name;
    public $description;
    public $price;
    public $is_active;

    public function mount($id)
    {
        $this->menuItem = MenuItem::findOrFail($id);

        $this->name = $this->menuItem->name;
        $this->description = $this->menuItem->description;
        $this->price = $this->menuItem->price;
        $this->is_active = $this->menuItem->is_active;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $this->menuItem->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'is_active' => $this->is_active,
        ]);

        session()->flash('success', 'Menu item updated successfully.');

        return redirect()->route('menu-items.list');
    }

    public function render()
    {
        return view('livewire.Menu.edit-item')
            ->layout('layouts.app');
    }
}