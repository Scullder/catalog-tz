<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = 0;

        $products = [];
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $products[] = [
                    'id' => $productId,
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'total' => $product->price * $item['quantity']
                ];
                $total += $product->price * $item['quantity'];
            }
        }

        return view('cart.index', compact('products', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        // $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->input('quantity', 1);
        } else {
            $cart[$product->id] = [
                'quantity' => $request->input('quantity', 1),
                'name' => $product->name,
                // 'price' => $product->price
            ];
        }

        session()->put('cart', $cart);

        // return redirect()->back()->with('success', 'Товар добавлен в корзину');

        return response()->json([
            'success' => true,
            'cartCount' => count($cart)
        ]);
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        // return redirect()->back()->with('success', 'Товар удалён из корзины');

        return response()->json([
            'success' => true,
            'cartCount' => count($cart)
        ]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255'
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Корзина пуста');
        }

        $total = 0;
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            $total += $product->price * $item['quantity'];
        }

        $orderData = [
            'customer_name' => $request->input('customer_name'),
            'customer_email' => $request->input('customer_email'),
            'comment' => $request->input('comment'),
            'user_id' => auth()->id(),
            'total' => $total,
        ];

        $order = Order::create($orderData);

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            $order->products()->attach($productId, [
                'product_name' => $product->name,
                'price' => $product->price,
                'quantity' => $item['quantity']
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order)
            ->with('success', 'Заказ успешно оформлен!');
    }
}
