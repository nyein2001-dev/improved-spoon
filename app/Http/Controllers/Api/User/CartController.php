<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\ShoppingCart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function translate($lang_code)
    {
        $front_lang = Session::put('front_lang', $lang_code);
        config(['app.locale' => $lang_code]);
    }

    public function cart_items(Request $request)
    {

        $this->translator($request->lang_code);

        $user = Auth::guard('api')->user();

        $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'add_to_cart'])->latest()->get();

        $recomend_products = Product::select('id', 'slug', 'thumbnail_image', 'status', 'regular_price', 'offer_price')->where(['status' => 1])->latest()->take(9)->get();

        return response()->json([
            'items' => $items,
            'recomend_products' => $recomend_products,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
