<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::all();
        return response()->json($carts, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $cart = Cart::where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            $cart->quantity = $cart->quantity + 1;
            $cart->save();
            return response()->json($cart, 200);
        }

        // If it doesn't exist, create a new cart entry
        $cart = Cart::create($request->all());
        return response()->json($cart, 201);
    }

    public function show($id)
    {
        $cart = Cart::findOrFail($id);
        return response()->json($cart, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|required|exists:users,id',
            'product_id' => 'sometimes|required|exists:products,id',
            'quantity' => 'sometimes|required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $cart = Cart::findOrFail($id);
        $cart->update($request->all());
        return response()->json($cart, 200);
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return response()->json(null, 204);
    }

    public function getCarts()
    {
        $carts = Cart::all();
        return response()->json($carts, 200);
    }

    public function getCartById($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->product = $cart->product;
        $cart->user = $cart->user;
        return response()->json($cart, 200);
    }

    public function minusCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity -= 1;
        $cart->save();
        return response()->json($cart, 200);
    }

    public function plusCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity += 1;
        $cart->save();
        return response()->json($cart, 200);
    }
}
