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
                $productTotal = $product->price * $item['quantity'];
                $products[] = [
                    'id' => $productId,
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'product_total' => $productTotal,
                    'product_total_label' => $this->formatPrice($productTotal),
                ];
                $total += $product->price * $item['quantity'];
            }
        }

        $total = $this->formatPrice($total);

        return view('cart.index', compact('products', 'total'));
    }

    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $quantity;
            $cart[$product->id] = array_merge($cart[$product->id], [
                'quantity' => $quantity,
                'product_total' => $product->price * $quantity
            ]);
        } else {
            $cart[$product->id] = [
                'quantity' => $quantity,
                'name' => $product->name,
                'price' => $product->price,
                'product_total' => $product->price * $quantity
            ];
        }

        $cart[$product->id]['product_total_label'] = $this->formatPrice($cart[$product->id]['product_total']);

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cartCount' => count($cart),
            'total' => $this->formatPrice($this->getCartTotal($cart)),
            'product' => $cart[$product->id],
        ]);
    }

    private function getCartTotal(array $cart)
    {
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $total += $product->price * $item['quantity'];
            }
        }
 
        return $total;
    }

    private function formatPrice(float $price)
    {
        return number_format($price, 0, ',', ' ') . ' ₽';
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cartCount' => count($cart),
            'total' => $this->formatPrice($this->getCartTotal($cart)),
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

        $total = $this->getCartTotal($cart);

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

        return redirect()->route('catalog.index', $order)
            ->with('success', 'Заказ успешно оформлен!');
    }
}
