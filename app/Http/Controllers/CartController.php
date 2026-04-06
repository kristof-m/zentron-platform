<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function show(Request $request): View
    {
        $entries = $request->session()->get('cartEntries', []);
        $products = Product::findMany(array_keys($entries));

        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product->price * $entries[$product->id];
        }

        return view('cart', [
            'products' => $products,
            'amounts' => array_values($entries),
            'totalPrice' => $totalPrice,
        ]);
    }

    public function setAmount(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:Product,id',
            'amount' => 'required|integer|min:1',
        ]);
        /* @var $id int */
        $id = $validated['id'];
        /* @var $amount int */
        $amount = $validated['amount'];

        $entries = $request->session()->get('cartEntries');
        $entries[$id] = $amount;

        $request->session()->put('cartEntries', $entries);

        return redirect()->route('cart');
    }

    public function remove(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:Product,id',
        ]);
        /* @type $id int */
        $id = $validated['id'];

        $entries = $request->session()->get('cartEntries');

        if (array_key_exists($id, $entries)) {
            unset($entries[$id]);
            $request->session()->put('cartEntries', $entries);
        }

        return redirect()->route('cart');
    }
}
