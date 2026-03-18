<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\User;
use App\Models\Profile;
use App\Models\Item;
use App\Models\Order;
use App\Http\Requests\PurchaseRequest;
use App\Http\Livewire\PaymentSelector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //注文メソッド
    public function index(Request $request, $itemId)
    {
        //変数userIdはAuthファサードからログインIdとする
        $user = Auth::user();
        //変数profilesは認証ユーザーのprofileのデータを格納する
        $profiles = $user->profile;
        //変数itemsは前ページで選択したItemのデータを取得
        $items = Item::findOrFail($itemId);
        //送信されたpaymentMethodの値を取得
        $paymentMethod = $request->input('paymentMethod');
        //purchaseを表示する（変数user,profiles,items,paymentMethodをviewに渡す）
        return view('purchase', compact('user', 'profiles', 'items', 'paymentMethod'));
    }

    //購入情報登録メソッド（PurchaseRequestを使用する）
    public function store(PurchaseRequest $request, $itemId)
    {
        //変数userIdはAuthファサードからログインIdとする
        $user = Auth::user();
        //変数profilesは認証ユーザーのprofileのデータを格納する
        $profiles = $user->profile;
        //変数itemsは前ページで選択したItemのデータを取得
        $items = Item::findOrFail($itemId);
        //変数ordersはviewから呼び出した[user_id][item_id][payment_method][post][address][building]を格納する
        $orders = $request->only(['user_id', 'item_id','payment_method', 'post', 'address', 'building' ]);
        //変数orders['user_id]は認証userのidとする
        $orders['user_id'] = auth()->id();
        //変数orders['item_id]は選択したitemのidとする
        $orders['item_id'] = $itemId;
        //変数orders['payment_method']は呼び出したpayment_methodとする。
        $orders['payment_method'] = $request->payment_method;
        //orders['post']は取得したprofiles['post']
        $orders['post'] = $profiles['post'];
        //orders['post']は取得したprofiles['address']
        $orders['address'] = $profiles['address'];
        //orders['post']は取得したprofiles['building']
        $orders['building'] = $profiles['building'];
        //変数orderはOrderモデルを元に作成する
        Order::create($orders);
        //stripeの決済画面にリダイレクトする。
        return redirect("{$items['url']}");
    }
}
