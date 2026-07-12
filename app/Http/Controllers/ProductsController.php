<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Mpdf\Mpdf;

class ProductsController extends Controller
{
    public function index()
    {
        $product = Products::all();
        return view('product.index', compact('product'));
    }

    public function show()
    {
        $product = Products::all();
        return view('product.show', compact('product'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'name.required' => 'Nama produk wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'gambar.required' => 'Gambar wajib diisi',
            'gambar.image' => 'Gambar harus berupa file gambar',
            'gambar.mimes' => 'Gambar harus berupa file jpeg, png, jpg, atau gif',
            'gambar.max' => 'Gambar maksimal 2MB',
        ]);
        
        $data = $request->all();
        // Berikan category_id default karena foreign key ini wajib diisi di database
        $data['category_id'] = DB::table('category')->first()->id ?? 1;

        if ($request->hasFile('gambar')) {
            $imageFile = $request->file('gambar');
            
            $filename = time() . '.jpg';
            $image = Image::make($imageFile)->resize(1000, 1000);
            Storage::disk('public')->put('images/' . $filename, (string) $image->encode('jpg'));
            $data['gambar'] = 'images/' . $filename;
        }
        
        Products::create($data);
        return redirect('/product')->with('success', 'Data berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $product = Products::find($id);
        return view('product.edit', ['p' => $product]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'name.required' => 'Nama produk wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'gambar.image' => 'Gambar harus berupa file gambar',
            'gambar.mimes' => 'Gambar harus berupa file jpeg, png, jpg, atau gif',
            'gambar.max' => 'Gambar maksimal 2MB',
        ]);

        $product = Products::find($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $imageFile = $request->file('gambar');
            $filename = time() . '.jpg';
            
            $image = Image::make($imageFile)->resize(300, 300);
            Storage::disk('public')->put('images/' . $filename, (string) $image->encode('jpg'));
            
            // Hapus gambar lama agar storage tidak penuh
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }
            
            $data['gambar'] = 'images/' . $filename;
        } else {
            unset($data['gambar']); // Jangan update gambar jika tidak ada file yang diunggah
        }

        $product->update($data);
        return redirect('/product')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $product = Products::find($id);
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }
        $product->delete();
        return redirect('/product');
    }

    private function buildPdf(): array
    {
        $products = Products::orderBy('name')->get();
        $html     = view('product.pdf', compact('products'))->render();

        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            'format'        => 'A4',
            'orientation'   => 'P',
            'margin_top'    => 15,
            'margin_bottom' => 15,
            'margin_left'   => 15,
            'margin_right'  => 15,
        ]);

        $mpdf->SetTitle('Laporan Data Produk');
        $mpdf->SetAuthor('SistemCRUD');
        $mpdf->SetCreator('SistemCRUD - mPDF');
        $mpdf->WriteHTML($html);

        $filename = 'Laporan_Produk_' . now()->format('Ymd_His') . '.pdf';

        return [$mpdf, $filename];
    }

    /**
     * Tampilkan PDF langsung di browser (preview).
     */
    public function previewPdf()
    {
        [$mpdf, $filename] = $this->buildPdf();

        return response($mpdf->Output($filename, 'S'), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }

    /**
     * Paksa unduh PDF (download).
     */
    public function downloadPdf()
    {
        [$mpdf, $filename] = $this->buildPdf();

        return response($mpdf->Output($filename, 'S'), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}