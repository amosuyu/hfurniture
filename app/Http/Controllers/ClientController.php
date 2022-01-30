<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\BlogTypes;
use App\Models\Categories;
use App\Models\Collections;
use App\Models\Comments;
use App\Models\Colors;
use App\Models\User;
use App\Models\Policies;
use App\Models\Products;
use App\Repositories\ProductsRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Contracts\Session\Session;
use App\Models\Cart;
use App\Helper\Helper;

Paginator::useBootstrap();

class ClientController extends Controller
{
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    // return dữ liệu cho trang home
    public function index()
    {
        $collections = Collections::all();
        $blogs = Blogs::all();
        $hotProducts = Products::getByHot();
        $sellingProducts = Products::getBySelling();
        $bestDealProducts = Products::getByBestDeal();
        $newProducts = Products::orderBy('created_at', 'DESC')->limit(5)->get();
        return view('client.home', compact('collections', 'blogs', 'newProducts', 'hotProducts', 'sellingProducts', 'bestDealProducts'));
    }

    // return sản phẩm theo category
    public function productsByCategory(Request $request, $id = null)
    {
        $params = $request->query();
        $categories = Categories::all();
        $colors = Colors::all();
        $products = $this->productsRepository->getAllByCategoryId($id, $params)->paginate(9);
        return view('client.product_list', compact('products', 'categories', 'colors', 'params'));
    }

    // return sản phẩm theo collection
    public function productsByCollection(Request $request, $id = null)
    {
        $params = $request->query();
        $collections = Collections::all();
        $colors = Colors::all();
        $products = $this->productsRepository->getAllByCollectionId($id, $params)->paginate(9);
        return view('client.product_collection_list', compact('products', 'collections', 'colors', 'params'));
    }

    // return trang liên hệ
    public function contact()
    {
        return view('client.contact');
    }
    // return trang thông tin cửa hàng
    public function aboutus()
    {
        return view('client.aboutus');
    }
    // return trang chính sách
    public function policy($id)
    {
        $policy = Policies::find($id);
        return view('client.policy', compact('policy'));
    }

      // return trang sản phẩm chi tiết
    public function productDetail($id)
    {
        $product = $this->productsRepository->findById($id);
        if($product != null){
            $categories = Categories::all();
            $relatedProducts = $this->productsRepository->getRelatedProducts($id, $product->category_id);
            $recentProducts = $this->productsRepository->getRecentProducts();
            $starsRating = Helper::instance()->stars_averaged($id);
            $comments = Comments::with('users')->where('product_id', $id)->orderBy('created_at', 'DESC')->get();
            $rateQuantity = Comments::where('product_id', $id)->where('rate','>', 0)->count();
            return view('client.product_detail', compact('product', 'categories', 'relatedProducts', 'recentProducts', 'comments', 'starsRating', 'rateQuantity'));
        }else {
            return redirect('/');
        }
        
    }

    // return trang tin tức chi tiết
    public function blogDetail($id)
    {
        $blog = Blogs::find($id);
        $blogTypes = BlogTypes::all();
        $otherBlogs = Blogs::where('id', '<>', $id)->limit(5)->orderBy('created_at', 'DESC')->get();
        return view('client.blog_detail', compact('blog', 'blogTypes', 'otherBlogs'));
    }

    // return trang danh sách tin tức
    public function blogList($id)
    {
        $blogs = Blogs::where('blog_type_id', $id)->orderBy('id','DESC')->paginate(8);
        $blogTypes = BlogTypes::all();
        return view('client.blog_list', compact('blogs', 'blogTypes'));
    }

    // thay đổi ngôn ngữ website
    public function changeLanguage(Request $request, $language){
        $request->Session()->put('website_language', $language);
        return redirect()->back();
    }

    // gửi bình luận và đánh giá
    public function sendComment(Request $request){
        $data = [
            'user_id' => Auth()->user()->id,
            'product_id' => $request->data['id'],
            'rate' => (int)$request->data['rate'] > 0 ? (int)$request->data['rate'] : null,
            'content' => $request->data['content']
        ];
        $result = Comments::create($data);
        $comments = Comments::with('users')->where('product_id', $data['product_id'])->orderBy('created_at', 'DESC')->get();
        return view('client.comments', compact('comments'));
    }
    
    // render tổng số sao đánh giá
    public function renderRating($id){
        $rateQuantity = Comments::where('product_id', $id)->where('rate','>', 0)->count();
        $starsRating = Helper::instance()->stars_averaged($id);
        return view ('client.render_rating', compact('rateQuantity', 'starsRating'));
    }

    public function searchProduct(Request $request){
        if ($request->ajax()) {
            $output = '';
            $products = $this->productsRepository->getBySearch($request);
            if ($products) {
                foreach ($products as $key => $product) {
                    $name = Session("website_language") == "en" ? $product->name_en : $product->name_vi;
                    $output .= '<tr>
                    <td> <a href="'. route("productDetail", $product->id) .'"><img src="'. asset($product->image) .'" style="width: 80px"> </a> <td>
                    <td> <a href="'. route("productDetail", $product->id) .'">' . $name . '</a></td>
                    <td>' . number_format($product->price) . 'đ</td>
                    </tr>';
                }
            }
            
            return Response($output);
        }
    }
}
