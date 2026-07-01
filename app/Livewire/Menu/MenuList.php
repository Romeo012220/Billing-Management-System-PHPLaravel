<?php

namespace App\Livewire\Menu;

use App\Models\MenuItem;
use Livewire\Component;

class MenuList extends Component
{
    public $search = '';
    public $categoryFilter = 'Pizza'; // Default category

    public function delete($id)
    {
        MenuItem::findOrFail($id)->delete();

        session()->flash('success', 'Menu item deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $item = MenuItem::findOrFail($id);

        $item->update([
            'is_active' => !$item->is_active,
        ]);

        session()->flash(
            'success',
            $item->is_active
                ? 'Menu item enabled successfully.'
                : 'Menu item disabled successfully.'
        );
    }

    public function render()
    {
        $menuItems = MenuItem::query()
            ->when($this->categoryFilter, function ($query) {
                $query->where('category', $this->categoryFilter);
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('item_code', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->get();

        return view('livewire.Menu.menu-list', [
            'menuItems' => $menuItems,
        ])->layout('layouts.app');
    }
}