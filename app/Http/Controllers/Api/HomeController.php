<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MailHelper;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Category;
use App\Models\CookieConsent;
use App\Models\EmailTemplate;
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
use App\Models\Subscriber;
use App\Models\TawkChat;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


use App\Mail\SubscriptionVerification;

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
            $filePath = base_path('lang/' . $lang_code . '/user.php');
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

    public function newsletter_request(Request $request)
    {

        $this->translator($request->lang_code);

        $rules = [
            'email' => 'required|unique:subscribers',
            'redirect_url' => 'required',
        ];

        $customMessages = [
            'email.required' => trans('user_validation.Email is required'),
            'redirect_url.required' => trans('user_validation.Url is required')
        ];

        $this->validate($request, $rules, $customMessages);

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->verified_token = Str::random(25);
        $subscriber->save();

        MailHelper::setMailConfig();

        $template = EmailTemplate::where('id', 3)->first();
        $message = $template->description;
        $subject = $template->subject;

        $verification_link = route('newsletter-verification') . '?verification_link=' . $subscriber->verified_token . '&email=' . $subscriber->email . '&redirect_url=' . $request->redirect_url;
        $verification_link = '<a href="' . $verification_link . '">' . $verification_link . '</a>';

        try {
            Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber, $message, $subject, $verification_link));
        } catch (Exception $ex) {
        }

        return response()->json(['message' => trans('user_validation.A verification link send to your mail, please check and verify it')]);
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
