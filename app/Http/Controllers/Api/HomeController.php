<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Category;
use App\Models\CookieConsent;
use App\Models\ErrorPage;
use App\Models\FacebookPixel;
use App\Models\Footer;
use App\Models\FooterSocialLink;
use App\Models\GoogleAnalytic;
use App\Models\GoogleRecaptcha;
use App\Models\Language;
use App\Models\MaintainanceText;
use App\Models\MultiCurrency;
use App\Models\Setting;
use App\Models\TawkChat;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function translator($lang_code)
    {

        if ($lang_code) {
            $lang_code = $lang_code;
        } else {
            $default_lang = Language::where('id', '1')->first();
            if ($default_lang) {
                $lang_code = $default_lang->lang_code;
            } else {
                $lang_code = 'en';
            }
        }

        Session::put('front_lang', $lang_code);
        config(['app.locale' => $lang_code]);
    }

    public function website_setup(Request $request)
    {
        $setting = Setting::select('id', 'logo', 'favicon', 'default_avatar', 'topbar_phone', 'topbar_email', 'topbar_address')->first();
        $languages = Language::where('status', 1)->get();
        $currencies = MultiCurrency::where('status', 1)->get();
        $localizations = [];

        if ($request->lang_code) {
            $lang_code = $request->lang_code;
        } else {
            $default_lang = Language::where('id', 1)->first();
            if ($default_lang) {
                $lang_code = $default_lang->lang_code;
            } else {
                $lang_code = 'en';
            }
        }

        $this->translator($lang_code);
        try {
            $filePath = base_path('lang/'.$lang_code.'/user.php');
            if (file_exists($filePath)) {
                $localizations = include($filePath);
            } else {
                throw new Exception("Localization file not found: $filePath");
            }
        } catch (Exception $ex) {
            return response()->json([
                'message' => 'Something went wrong: ' . $ex->getMessage()
            ], 403);
        }


        $categories = Category::select('id', 'slug', 'icon', 'status')->where('status', 1)->latest()->get();

        $links = FooterSocialLink::all();

        $homepage_ads = Ad::where('id', 1)->first();
        $shoppage_ads = Ad::where('id', 2)->first();
        $shop_detail_ads = Ad::where('id', 3)->first();

        $maintainance = MaintainanceText::first();
        $cookieConsent = CookieConsent::first();
        $googleRecaptcha = GoogleRecaptcha::first();
        $tawkChat = TawkChat::first();
        $googleAnalytic = GoogleAnalytic::first();
        $facebookPixel = FacebookPixel::first();

        $errorpage = ErrorPage::first();

        $footer = Footer::select('id', 'copyright', 'description')->first();

        $languages = Language::where('status', 1)->orderBy('is_default', 'DESC')->get();

        return response()->json([
            'setting' => $setting,
            'languages' => $languages,
            'localizations' => $localizations,
            'currencies' => $currencies,
            'categories' => $categories,
            'social_links' => $links,
            'homepage_ads' => $homepage_ads,
            'shoppage_ads' => $shoppage_ads,
            'shop_detail_ads' => $shop_detail_ads,
            'maintainance' => $maintainance,
            'cookieConsent' => $cookieConsent,
            'googleRecaptcha' => $googleRecaptcha,
            'tawkChat' => $tawkChat,
            'googleAnalytic' => $googleAnalytic,
            'facebookPixel' => $facebookPixel,
            'errorpage' => $errorpage,
            'footer' => $footer,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
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
