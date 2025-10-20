<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\GstBillController;

// Index routes
Route::get('/', [AppController::class, 'index'] );

// Add Party routes
Route::get('/add-party', [PartyController::class, 'addParty'])->name('add-party');
Route::post('/create-party', [PartyController::class, 'createParty'])->name('create-party');
Route::get('/manage-parties', [PartyController::class, 'index'])->name('manage-parties');
Route::get('/edit-party/{id}', [PartyController::class, 'editParty'])->name('edit-party');
Route::put('/update-party/{id}', [PartyController::class, 'updateParty'])->name('update-party');
Route::delete('/delete-party/{party}', [PartyController::class, 'deleteParty'])->name('delete-party');

// Gst bill routes
Route::get('/add-gst-bill', [GstBillController::class, 'index'])->name('add-gst-bill');
Route::get('/manage-gst-bills', [GstBillController::class, 'addGstBill'])->name('manage-gst-bills');
Route::get('/print-gst-bill/{id}', [GstBillController::class, 'addParty'])->name('print-gst-bill');
Route::get('/create-gst-bill', [GstBillController::class, 'createGstBill'])->name('create-gst-bill');
