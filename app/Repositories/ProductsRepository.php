<?php
namespace App\Repositories;

use App\Models\ProductDetails;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

class ProductsRepository
{
    public function getAll($params)
    {
        $query = Products::with('collections', 'categories');
        if (isset($params['filterCollection'])) {
            $query->where('collection_id', $params['filterCollection']);
        }
        if (isset($params['filterCategory'])) {
            $query->where('category_id', $params['filterCategory']);
        }
        if (isset($params['filterKeyword'])) {
            $query->where(function ($q) use ($params) {
                $q->where('name_vi', 'LIKE', '%' . $params['filterKeyword'] . '%')
                    ->orWhere('name_en', 'LIKE', '%' . $params['filterKeyword'] . '%');
            });
        }
        $query->orderBy('id', 'desc')->get();
        return $query;
    }

    public function getById($id)
    {
        $query = Products::with('collections', 'categories')->where('id', $id)->first();
        return $query;
    }
    public function getAllBySpaceId($id)
    {
        $query = Products::with('collections', 'categories')->where('space_id', $id)->paginate(20);
        return $query;
    }

    public function getAllByCategoryId($id, $params)
    {
        $query = Products::with('collections', 'categories', 'details');
        $query->select('products.*');
        if($id != null){
            $query->where('category_id', $id);
        }
        $query->leftJoin('product_details', 'product_details.product_id', 'products.id')->groupBy('products.id');
        $query = $this->filterFunction($query, $params);
        return $query;
    }

    public function getAllByCollectionId($id, $params)
    {
        $query = Products::with('collections', 'categories', 'details');
        $query->select('products.*');
        if($id != null){
            $query->where('collection_id', $id);
        }
        $query->leftJoin('product_details', 'product_details.product_id', 'products.id')->groupBy('products.id');
        $query = $this->filterFunction($query, $params);
        return $query;
    }

    public function findById($id)
    {
        return Products::with('collections', 'categories', 'details', 'details.colors')->where('id', $id)->first();
    }

    public function getRelatedProducts($id, $categoryId)
    {
        return Products::where('category_id', $categoryId)->where('id', '<>', $id)->orderBy('created_at', 'DESC')->get();
    }

    public function getRecentProducts()
    {
        return Products::orderBy('created_at', 'DESC')->limit(6)->get();
    }

    public function create($params)
    {
        DB::beginTransaction();
        try {
            foreach ($params->all() as $key => $item) {
                $explode = explode("_", $key);

                if ($explode[0] == 'quantity' && $item != null) {
                    $array[$explode[1]] = ['quantity' => $item];
                }
                if ($explode[0] == 'file' && $item != null) {
                    $array[$explode[1]]['file'] = $item;
                }
            }
            $data = $params->all();
            if ($params->hasFile('image')) {
                $image = $params->file('image');
                $image->move('upload/images', $image->getClientOriginalName());
                $filePath = 'upload/images/' . $params->file('image')->getClientOriginalName();
            } else {
                $filePath = null;
            }
            $data['image'] = $filePath;
            $data['slug'] = is_null($data['slug']) ? str_slug($params->name_vi) : str_slug($params->slug);
            $product = Products::create($data);
            if ($product) {
                foreach ($array as $key => $ar) {
                    $filePath = '';
                    if (isset($ar['file']) && $ar['file'] != null) {
                        foreach ($ar['file'] as $file) {
                            $image = $file;
                            $image->move('upload/images', $image->getClientOriginalName());
                            $filePath .= 'upload/images/' . $file->getClientOriginalName() . ',';
                        }
                    }
                    $data = [
                        'quantity' => $ar['quantity'],
                        'color_id' => $key,
                        'product_id' => $product->id,
                        'images' => $filePath,
                    ];
                    ProductDetails::create($data);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function update($id, $params)
    {
        DB::beginTransaction();
        try {
            $row = Products::find($id);
            $data = $params->all();
            if ($params->hasFile('image')) {
                $image = $params->file('image');
                $image->move('upload/images', $image->getClientOriginalName());
                $filePath = 'upload/images/' . $params->file('image')->getClientOriginalName();
                $data['image'] = $filePath;
            }
            $data['slug'] = is_null($data['slug']) ? str_slug($params->name_vi) : str_slug($params->slug);
            $row->update($data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function filterFunction($query, $params)
    {
        if (isset($params['color'])) {
            $query->where('product_details.color_id', $params['color']);
        }
        if (isset($params['price'])) {
            $query->where(function ($q) use ($params) {
                if (in_array('offer1', $params['price'])) {
                    $q->orWhere('price', '<', 1000000);
                }
                if (in_array('offer2', $params['price'])) {
                    $q->orWhere(function ($q) {
                        $q->whereBetween('price', [500000, 1000000]);
                    });
                }
                if (in_array('offer3', $params['price'])) {
                    $q->orWhere(function ($q) {
                        $q->whereBetween('price', [1000000, 1500000]);
                    });
                }
                if (in_array('offer4', $params['price'])) {
                    $q->orWhere(function ($q) {
                        $q->whereBetween('price', [2000000, 5000000]);
                    });
                }
                if (in_array('offer5', $params['price'])) {
                    $q->orWhere('price', '>', 5000000);
                }
            });
        }
        if (isset($params['toSort'])) {
            switch ($params['toSort']) {
                case "latest":
                    $query->orderBy('created_at', 'DESC');
                    break;
                case "oldest":
                    $query->orderBy('created_at', 'ASC');
                    break;
                case "hot":
                    $query->orderBy('hot', 'DESC');
                    break;
                case "price-ascending":
                    $query->orderBy('price', 'ASC');
                    break;
                case "price-descending":
                    $query->orderBy('price', 'DESC');
                    break;
                case "title-ascending":
                    $query->orderBy('name_vi', 'ASC');
                    break;
                case "title-descending":
                    $query->orderBy('name_vi', 'DESC');
                    break;
                case "best-selling":
                    $query->orderBy('sold', 'DESC');
                    break;
                case "big-sale":
                    $query->orderBy('discount', 'DESC');
                    break;
                default:
                    break;
            }
        } else {
            $query->orderBy('created_at', 'DESC');
        }

        return $query;
    }

    public function getByIdDetail($id)
    {
        $query = ProductDetails::where('product_details.id', $id)->join('products', 'products.id', 'product_details.product_id')
            ->join('colors', 'colors.id', 'product_details.color_id')
            ->select([
                'product_details.*',
                'products.price as price',
                'products.discount as discount',
                'products.image as image',
                'products.name_vi as nameVi',
                'products.name_en as nameEn',
                'colors.code as color',
            ])
            ->first();
        return $query;
    }

    public function getProductForCompleteOrder($id, $color)
    {
        $query = Products::withTrashed()->where('products.id', $id)
            ->join('product_details', 'products.id', 'product_details.product_id')
            ->join('colors', 'colors.id', 'product_details.color_id')
            ->where('colors.id', $color)
            ->select([
                'products.name_vi as nameVi',
                'products.name_en as nameEn',
                'colors.code as color',
            ])
            ->first();
         
        return $query;
        
    }


    public function getTop5(){
        return Products::orderBy('sold', 'desc')->select('name_vi','name_en','sold')->limit(5)->get();
    }

    public function getBySearch($request){
        return Products::where('name_vi', 'LIKE', '%' . $request->search . '%')->orWhere('name_en', 'LIKE', '%' . $request->search . '%')->limit(5)->get();
    }
}
