<?php

namespace App\Livewire\Transactions;

use Livewire\Component;
use App\Models\MenuItem;

class Payment extends Component
{
    public $search = '';
    public $categoryFilter = 'Pizza';

    public $cart = [];
    public $cashReceived = 0;
    public $subtotal = 0;
    public $total = 0;
    public $change = 0;

    public function updatedCashReceived()
    {
        $this->calculateTotals();
    }

    public function addToCart($itemId)
    {
        $item = MenuItem::find($itemId);

        if (!$item) {
            return;
        }

        foreach ($this->cart as $index => $cartItem) {
            if ($cartItem['id'] == $item->id) {
                $this->cart[$index]['quantity']++;
                $this->calculateTotals();
                return;
            }
        }

    $this->cart[] = [
    'id' => $item->id,
    'name' => $item->name,
    'category' => $item->category,
    'image' => $item->image,
    'price' => $item->price,
    'quantity' => 1,
];

        $this->calculateTotals();
    }

    public function increaseQty($index)
    {
        if (isset($this->cart[$index])) {
            $this->cart[$index]['quantity']++;
            $this->calculateTotals();
        }
    }

    public function decreaseQty($index)
    {
        if (isset($this->cart[$index])) {
            if ($this->cart[$index]['quantity'] > 1) {
                $this->cart[$index]['quantity']--;
            } else {
                unset($this->cart[$index]);
                $this->cart = array_values($this->cart);
            }

            $this->calculateTotals();
        }
    }

    public function removeItem($index)
    {
        if (isset($this->cart[$index])) {
            unset($this->cart[$index]);
            $this->cart = array_values($this->cart);
            $this->calculateTotals();
        }
    }

    public function clearCart()
    {
        $this->cart = [];
        $this->cashReceived = 0;
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = collect($this->cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $this->total = $this->subtotal;
        $this->change = max(0, $this->cashReceived - $this->total);
    }

    public function processPayment()
    {
        $this->calculateTotals();

        if (empty($this->cart)) {
            session()->flash('error', 'Cart is empty.');
            return;
        }

        if ($this->cashReceived < $this->total) {
            session()->flash('error', 'Cash received is not enough.');
            return;
        }

        session()->flash('success', 'Payment successful!');

        $this->clearCart();
    }

    public function render()
    {
        $items = MenuItem::query()
            ->where('is_active', true)
            ->when($this->categoryFilter, function ($query) {
                $query->where('category', $this->categoryFilter);
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('item_code', 'like', '%' . $this->search . '%')
                        ->orWhere('category', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->take(12)
            ->get();

        return view('livewire.Transactions.payment', [
            'items' => $items,
        ]);
    }


    public function getGroupedCartProperty()
{
    return collect($this->cart)->groupBy('category');
}
}