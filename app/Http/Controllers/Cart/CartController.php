<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qtybutton' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $productVariation = ProductVariation::findOrFail(json_decode($request->variation)->id);

        if ($request->qtybutton > $productVariation->quantity) {
            toastr()->closeButton()->error('تعداد وارد شده از محصول درست نمی باشد');
            return redirect()->back();
        }

        $rowId = $product->id . '-' . $productVariation->id;
        $cart = session()->get('cart', []);

        if (!isset($cart[$rowId])) {
            $cart[$rowId] = [
                'id' => $rowId,
                'name' => $product->name,
                'price' => $productVariation->price,
                'quantity' => $request->qtybutton,
                'attributes' => $productVariation->toArray(),
                'product_id' => $product->id,
                'variation_id' => $productVariation->id
            ];
        } else {
            $cart[$rowId]['quantity'] += $request->qtybutton;
        }

        session()->put('cart', $cart);

        toastr()->closeButton()->success('محصول مورد نظر به سبد خرید شما اضافه شد');
        return redirect()->back();
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.show', compact('cart'));
    }
    public function remove(Request $request)
    {
        $rowId = $request->rowId;
        $cart = session()->get('cart', []);

        if (isset($cart[$rowId])) {
            unset($cart[$rowId]);
            session()->put('cart', $cart);
            toastr()->closeButton()->success('محصول مورد نظر از سبد خرید شما حذف شد');
        }

        return redirect()->back();
    }

    public function index()
    {
        return view('cart.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'qtybutton' => 'required|array',
            'qtybutton.*' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        foreach ($request->qtybutton as $rowId => $quantity) {
            $cartItem = $cart[$rowId] ?? null;

            if ($cartItem) {
                $productVariation = ProductVariation::findOrFail($cartItem['variation_id']);

                // Check if the requested quantity exceeds available stock
                if ($quantity > $productVariation->quantity) {
                    toastr()->closeButton()->error('تعداد وارد شده از محصول درست نمی باشد');
                    return redirect()->back();
                }

                // Update quantity in cart
                $cart[$rowId]['quantity'] = $quantity;
            } else {
                toastr()->closeButton()->error('آیتمی برای به‌روزرسانی پیدا نشد');
                return redirect()->back();
            }
        }

        session()->put('cart', $cart);
        toastr()->closeButton()->success('سبد خرید شما ویرایش شد');
        return redirect()->back();
    }
    public function clear()
    {
        session()->forget('cart');

        toastr()->closeButton()->success('سبد خرید شما پاک شد');
        return redirect()->back();
    }


}
