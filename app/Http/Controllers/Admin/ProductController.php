<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Slice;
use App\Traits\ImageTrait;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductGallery;

class ProductController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(25);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::select('id', 'name', 'status', 'parent_id')
            ->whereNull('parent_id')
            ->with('getChildrenCategory')
            ->active()->get();
        return view('admin.product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (request('slug') != null) {
            $request['slug']  = Str::slug(request('slug'), '-');
        } else {
            $request['slug']  = Str::slug(request('english_name'), '-');
        }

        $this->validate(request(), [
            'tamil_name' => 'required|unique:products,tamil_name',
            'english_name' => 'required|unique:products,english_name',
            'slug' => 'required|alpha_dash|unique:products,slug',
            'type' => 'required',
            'grossweight' => 'required',
            'netweight' => 'required',
            'regular_price' => 'required',
            'status' => 'required',
        ]);

        $path = null;

        if ($request->file('image')) {
            $file = $request->file('image');
            $file_arr = $this->upload_file($file, 'products');
            $path = $file_arr['db_path'];
        }
        // dd($request);
        $datas = [
            'tamil_name' => $request->tamil_name,
            'english_name' => $request->english_name,
            'slug' => $request->slug,
            'category_id' => $request->parent_id,
            'type' => $request->type,
            'grossweight' => $request->grossweight,
            'netweight' => $request->netweight,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'stock' => $request->stock,
            'image' => $path,
            'is_stock_available' => $request->is_stock_available,
            'is_product_customizeable' => ($request->is_product_customizeable == 'on') ? 1 : 0,
        ];

        if ($path == null) {
            unset($datas['image']);
        }
        Product::create($datas);
        return redirect()->route('admin.product.index')->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::select('id', 'name', 'status', 'parent_id')
            ->whereNull('parent_id')
            ->with('getChildrenCategory')
            ->active()->get();
        $data = Product::find($id);
        $pieces = Slice::get();

        return view('admin.product.edit', compact('data', 'category', 'pieces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (request('slug') != null) {
            $request['slug']  = Str::slug(request('slug'), '-');
        } else {
            $request['slug']  = Str::slug(request('english_name'), '-');
        }

        $this->validate(request(), [
            'tamil_name' => 'required|unique:products,tamil_name,' . $id,
            'english_name' => 'required|unique:products,english_name,' . $id,
            'slug' => 'required|alpha_dash|unique:products,slug,' . $id,
            'type' => 'required',
            'grossweight' => 'required',
            'netweight' => 'required',
            'regular_price' => 'required',
            'status' => 'required',
        ]);

        $path = null;

        if ($request->file('image')) {
            $file = $request->file('image');
            $file_arr = $this->upload_file($file, 'products');
            $path = $file_arr['db_path'];
        }

        $datas = [
            'tamil_name' => $request->tamil_name,
            'english_name' => $request->english_name,
            'slug' => $request->slug,
            'category_id' => $request->parent_id,
            'type' => $request->type,
            'grossweight' => $request->grossweight,
            'netweight' => $request->netweight,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'stock' => $request->stock,
            'image' => $path,
            'is_stock_available' => $request->is_stock_available,
            'is_product_customizeable' => ($request->is_customizable_product == 1) ? 1 : 0,
        ];

        if ($path == null) {
            unset($datas['image']);
        }

        Product::where('id', $id)->update($datas);
        return redirect()->route('admin.product.index')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product Deleted Successfully');
    }

    public function uploadGalleryImages(Request $request)
    {
        $this->validate(request(), [
            'id' => 'required',
            'images' => 'required|array',
        ]);

        $files = $request->file('images');
        if (!empty($files)) {
            foreach ($files as $file) {
                $file_arr = $this->upload_file($file, 'products_gallery');
                $path = $file_arr['db_path'];
                ProductGallery::create([
                    'product_id' => $request->id,
                    'image' => $path,
                ]);
            }
        }
        return redirect()->route('admin.product.edit', $request->id)->with('success', 'Product Gallery Images Upload Successfully');
    }

    public function deleteImage($product, $gallery)
    {
        ProductGallery::find($gallery)->delete();
        return redirect()->route('admin.product.edit', $product)->with('success', 'Product Gallery Deleted Successfully');
    }

    public function slices(Request $request)
    {
        foreach($request->products as $slice) {
            if(isset($slice['slice_image']) && !empty($slice['slice_image']) ) {
                $path = $slice['slice_image']->store('public/images');
                $save = new Slice;
                $save->slice_image = $path;
                $save->name = $slice['name'];
                $save->num_of_pieces = $slice['pieces'];
                $save->product_id = $request->id;
                Product::where('id', $request->id)
                        ->update(array('is_product_customizeable' => $request->is_customizable_product));
                $save->save();
            }
        }

        return redirect()->route('admin.product.edit',$request->id)->with('success', 'Product Gallery Deleted Successfully');

    }
}
