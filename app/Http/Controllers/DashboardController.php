<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role == 'admin') {
            return view('admin.dashboard');
        } elseif ($role == 'pemilik') {
            // Fetch the canteen owned by the authenticated user
            $canteen = DB::table('canteens')->where('owner_id', Auth::id())->first();
            if ($canteen) {
                // Fetch the products from the user's canteen
                $products = DB::table('products')
                    ->where('canteen_id', $canteen->id)
                    ->join('canteens', 'products.canteen_id', '=', 'canteens.id')
                    ->select('products.*', 'canteens.name as canteen_name')
                    ->orderBy('products.created_at', 'desc')
                    ->get();

                // Calculate total transactions for the products in the canteen
                $totalTransaction = DB::table('transactions')
                    ->whereIn('product_id', function ($query) use ($canteen) {
                        $query->select('id')
                            ->from('products')
                            ->where('canteen_id', $canteen->id);
                    })
                    ->count();

                // Calculate total income from the transactions related to the user's canteen
                $totalIncome = DB::table('transactions')
                    ->join('products', 'transactions.product_id', '=', 'products.id')
                    ->where('products.canteen_id', $canteen->id)
                    ->select(DB::raw('SUM(transactions.quantity * products.price) as total_income'))
                    ->first()
                    ->total_income;

                return view('pemilik.dashboard', compact('products', 'totalTransaction', 'totalIncome'));
            }

            return view('pemilik.dashboard')->with('error', 'Canteen not found for the current user.');
        } else {
            return view('pembeli.dashboard');
        }
    }

}
