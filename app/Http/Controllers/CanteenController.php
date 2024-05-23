<?php

namespace App\Http\Controllers;

use App\Models\Canteens;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CanteenController extends Controller
{
    public function index()
    {
        $canteens = Canteens::all();
        return view('canteen.index', compact('canteens'));
    }

    public function create()
    {
        $owners = User::where('role', 'pemilik')->get();
        return view('canteen.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'owner_id' => 'required',
        ]);

        Canteens::create($validate);

        return redirect()->back()->with('success', 'Canteen created successfully');
    }

    public function show($unique_code)
    {
        $canteen = DB::table('canteens')->where('unique_code', $unique_code)->first();
        $products = DB::table('products')->where('canteen_id', $canteen->id)->get();
        return view('canteen.products', compact('canteen', 'products'));
    }

    public function edit($id)
    {
        $canteen = Canteens::find($id);
        $owners = User::where('role', 'pemilik')->get();
        return view('canteen.edit', compact('canteen', 'owners'));
    }

    public function destroy($id)
    {
        Canteens::destroy($id);

        return redirect()->back()->with('success', 'Canteen deleted successfully');
    }

    public function pengaturan($unique_code)
    {
        $canteen = DB::table('canteens')->where('unique_code', $unique_code)->first();
        return view('canteen.pengaturan', compact('canteen'));
    }

    public function pengaturan_update(Request $request, $unique_code)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'owner_id' => 'required|integer',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $canteen = Canteens::where('unique_code', $unique_code)->firstOrFail();
        $canteen->update($validate);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('storage/thumbnail'), $thumbnail_name);

            $canteen->update(['thumbnail' => $thumbnail_name]);
        }

        return redirect()->back()->with('success', 'Canteen updated successfully');
    }
}
