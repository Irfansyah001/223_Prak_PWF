<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

        return view('product.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        $product = Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('product.create', compact('users'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.view', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'quantity' => 'sometimes|integer',
            'price' => 'sometimes|numeric',
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        $users = User::orderBy('name')->get();

        return view('product.edit', compact('product', 'users'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }

    public function export()
    {
        Gate::authorize('export-product');

        $products = Product::with('user')->get();

        $filename = 'products_' . now()->format('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($products) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['No', 'Name', 'Quantity', 'Price', 'Owner']);

            foreach ($products as $index => $product) {
                fputcsv($file, [
                    $index + 1,
                    $product->name,
                    $product->quantity,
                    $product->price,
                    $product->user->name ?? '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
