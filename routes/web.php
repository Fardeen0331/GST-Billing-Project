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

// Gst bill routes
Route::get('/add-gst-bill', [GstBillController::class, 'index'])->name('add-gst-bill');
Route::get('/manage-gst-bills', [GstBillController::class, 'addGstBill'])->name('manage-gst-bills');
Route::get('/print-gst-bill', [GstBillController::class, 'addParty'])->name('print-gst-bill');
