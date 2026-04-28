<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('merges guest cart into new user cart when login', function () {
    // Create product
    $product1 = new Product;
    $product1->name = 'Product 1';
    $product1->price = 10;
    $product1->description = 'Test Desc';
    $product1->save();

    // Create guest cart
    $guestOrder = new Order;
    $guestOrder->status = OrderStatus::InCart;
    $guestOrder->total_amount = 0;
    $guestOrder->save();
    
    $guestOrder->products()->attach($product1->id, ['amount' => 2]);
    $guestOrder->updateTotalAmount();
    
    // Put guest order ID in session
    Session::put('orderId', $guestOrder->id);    
    expect(Session::get('orderId'))->toBe($guestOrder->id);
    
    $user = User::factory()->create();

    // Trigger Login event manually
    Illuminate\Support\Facades\Auth::login($user);

    $user->refresh();

    // Assert session is cleared
    expect(Session::has('orderId'))->toBeFalse();

    // Assert guest order is deleted
    expect(Order::find($guestOrder->id))->toBeNull();

    // Assert user has a current order
    expect($user->current_order_id)->not->toBeNull();
    
    $userOrder = $user->currentOrder;
    expect($userOrder->products->count())->toBe(1);
    expect($userOrder->products->first()->id)->toBe($product1->id);
    expect($userOrder->products->first()->pivot->amount)->toBe(2);
    expect((int)$userOrder->total_amount)->toBe(20);
});