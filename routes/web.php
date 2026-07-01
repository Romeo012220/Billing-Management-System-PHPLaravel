<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Menu\AddItems;
use App\Livewire\Menu\MenuList;
use App\Livewire\Menu\EditItem;
use App\Livewire\Transactions\Payment;



Route::get('/', function () {
    return redirect()->route('menu-items.list');
});

Route::get('/menu-items', MenuList::class)->name('menu-items.list');
Route::get('/menu-items/add', AddItems::class)->name('menu-items.add');
Route::get('/menu-items/edit/{id}', EditItem::class)
    ->name('menu-items.edit');

Route::get('/payment', Payment::class)->name('payment');