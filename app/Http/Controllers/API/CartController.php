<?php

// app/Http/Controllers/API/CartController.php

namespace App\Http\Controllers\API;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $items = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($items);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $item = CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($item) {
            $item->quantity += $request->quantity;
            $item->save();
        } else {
            $item = CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'added_at' => now(),
            ]);
        }

        return response()->json($item->load('product'));
    }

    public function update(Request $request, $id)
    {
        $item = CartItem::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate(['quantity' => 'required|integer']);

        if ($request->quantity <= 0) {
            $item->delete();
            return response()->json(['deleted' => true]);
        }

        $item->update(['quantity' => $request->quantity]);

        return response()->json($item->load('product'));
    }

    public function destroy($id)
    {
        CartItem::where('id', $id)->where('user_id', Auth::id())->delete();
        return response()->json(['deleted' => true]);
    }

    public function clear()
    {
        CartItem::where('user_id', Auth::id())->delete();
        return response()->json(['cleared' => true]);
    }
}
