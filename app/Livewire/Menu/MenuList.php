<?php

namespace App\Livewire\Menu;

use App\Models\MenuItem;
use Livewire\Component;

class MenuList extends Component
{
    public $search = '';

    public function delete($id)
    {
        MenuItem::findOrFail($id)->delete();

        session()->flash('success', 'Menu item deleted successfully.');
    }

    public function render()
    {
        return view('livewire.Menu.menu-list', [
            'menuItems' => MenuItem::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->latest()
                ->get(),
        ])->layout('layouts.app');
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
}