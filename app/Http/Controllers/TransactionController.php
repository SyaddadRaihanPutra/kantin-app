<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $transacts = DB::table('transactions')
            ->join('products', 'transactions.product_id', '=', 'products.id')
            ->join('canteens', 'products.canteen_id', '=', 'canteens.id')
            ->select('transactions.*', 'products.name as product_name', 'canteens.name as canteen_name')
            ->orderBy('transactions.created_at', 'desc')
            ->paginate(10);
        return view('transactions.index', compact('transacts'));
    }

    public function order(Request $request)
    {
        // Validasi input
        $validate = $request->validate([
            'product_id' => 'required|exists:products,id', // Ensure the product exists
            'quantity' => 'required|numeric|min:1',
            'status' => 'required|string',
        ]);

        // Dapatkan harga dari database berdasarkan product_id
        $product = Products::findOrFail($validate['product_id']);
        $price = $product->price;

        // Hitung total_price berdasarkan quantity dan harga produk
        $total_price = $validate['quantity'] * $price;

        // Generate id baru menggunakan Str::random() dengan panjang 10 karakter
        $validate['id'] = Str::random(10);

        // Masukkan data ke dalam tabel transactions menggunakan DB facade
        DB::table('transactions')->insert([
            'id' => $validate['id'],
            'user_id' => auth()->id(),
            'product_id' => $validate['product_id'],
            'quantity' => $validate['quantity'],
            'total_price' => $total_price,
            'status' => $validate['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with([
            'id' => $validate['id'],
            'success' => 'Order created successfully',
            'user_id' => auth()->id(),
            'product_id' => $validate['product_id'],
            'quantity' => $validate['quantity'],
            'total_price' => $total_price,
            'status' => $validate['status'],
            'created_at' => now(),
        ]);
    }

    public function destroy($id)
    {
        // Hapus data berdasarkan id
        DB::table('transactions')->where('id', $id)->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Transaction deleted successfully');
    }

    public function history()
    {
        // Ambil data transaksi berdasarkan user_id
        $transacts = DB::table('transactions')
            ->join('products', 'transactions.product_id', '=', 'products.id')
            ->join('canteens', 'products.canteen_id', '=', 'canteens.id')
            ->select('transactions.*', 'products.name as product_name', 'canteens.name as canteen_name')
            ->where('user_id', auth()->id())
            ->orderBy('transactions.created_at', 'desc')
            ->paginate(10);

        // Tampilkan view history.pembeli dengan data transacts
        return view('pembeli.history', compact('transacts'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validate = $request->validate([
            'status' => 'required|in:diproses,dibatalkan,selesai'
        ]);

        // Update status transaksi berdasarkan id
        DB::table('transactions')->where('id', $id)->update([
            'status' => $validate['status'],
            'updated_at' => now(),
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Transaction updated successfully');
    }

}
