<?php

use App\Http\Livewire\LaboratoryComponent;
use App\Http\Livewire\MotorcycleComponent;
use App\Http\Livewire\OrderComponent;
use App\Http\Livewire\UserComponent;
use Illuminate\Support\Facades\Route;

Route::get('/users', UserComponent::class)->name('users');

Route::get('/motorcycles', MotorcycleComponent::class)->name('motorcycles');

Route::get('/laboratories', LaboratoryComponent::class)->name('laboratories');

Route::get('/orders', OrderComponent::class)->name('orders');