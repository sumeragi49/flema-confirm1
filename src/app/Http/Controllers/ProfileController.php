<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Profile;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    //indexメッソドを表示する
    public function index()
    {
        //現在認証しているユーザーを取得
        $user = Auth::user();
        //変数profilesは認証ユーザーのprofile
        $profiles = $user->profile;
        //「auth.profile」を表示（変数userをauth.profileに渡す）
        return view('auth.profile', compact('user', 'profiles'));
    }
    //profileの初回登録メソッド（ProfileRequestをバリデーションに使用）
    public function store(ProfileRequest $request)
    {
        //現在認証しているユーザーを取得
        $user = Auth::user();
        //viewより呼び出した[user_id][name][image][post][address][building]を$profilesに格納する。
        $profiles = $request->only(['user_id', 'name', 'image', 'post', 'address', 'building']);
        //$profile[user_id]は認証ユーザーのidとする。
        $profiles['user_id'] = auth()->id();
        //選択されたfileを名前を付けてstorageのimagesディレクトリに保存
        if($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs('profiles', $filename, 'public');

            $profiles['image'] = $filename;
        }
        //$profilesをProfileモデルを元に作成する
        Profile::create($profiles);
        //'/dashboard'にリダイレクトする
        return redirect('/dashboard');
    }
    //addressメソッドを選択したitemIdを元に表示
    public function address($itemId)
    {
        //現在認証しているユーザーを取得
        $user = Auth::user();
        //変数profilesは認証ユーザーのprofileのデータを格納する
        $profiles = $user->profile;
        //変数itemsは前ページで選択したItemのデータを取得
        $items = Item::findOrFail($itemId);
        //addressを表示、変数user,profiles,itemsをaddressに渡す
        return view('address', compact('user', 'profiles', 'items'));
    }

    //住所登録メソッド（addressRequestをバリデーションに使用）
    public function addressUpdate(addressRequest $request, $itemId)
    {
        //現在認証しているユーザーを取得
        $user = Auth::user();
        //変数profilesは認証ユーザーのprofileのデータを格納する
        $profiles = $user->profile;
        //変数itemsは前ページで選択したItemのデータを取得
        $items = Item::findOrFail($itemId);
        //viewより呼び出した[user_id][name][image][post][address][building]を$profilesに格納する。
        $profiles = $request->only(['user_id', 'image', 'name', 'post', 'address', 'building']);
        //idを元にデータを呼びだし、呼び出したデータ（$profiles）をProfileモデルを元にupdateする
        Profile::find($request->id)->update($profiles);
        //route(items.purchase)にリダイレクトする（変数user,profiles,itemsをviewに渡す）
        return redirect()->route('items.purchase', ['itemId' => $items->id])->with(compact('user', 'profiles', 'items'));
    }

    //profileの初回登録メソッド（ProfileRequestをバリデーションに使用）
    public function mypage(Request $request)
    {
        //変数userIdはAuthファサードからログインIdとする
        $user = Auth::user();

        $profiles = $user->profile;
        //変数tabはtabとrecommendのどちらか選択した方を呼び出す。
        $page = $request->query('page', 'sell');
        //変数itemsはItemモデルとOrderモデルのデータを取得する。
        //変数itemsの呼び出し方
        $items = [];
        //myListを選択した時
        if ($page === 'buy') {
            //変数likeItemIdsはLikeモデルに認証中のuser_idとitem_idの二つが登録された商品データを格納する

            $orderItems = Order::where('user_id', Auth::id())->pluck('item_id')->toArray();
            
            $items = Item::whereIn('id', $orderItems)->get();
            //変数itemsは「いいね」した商品データを取得する
        }else {
            //変数itemsは「認証userが出品した商品以外のデータを取得する
            $items = $user->items()->get();
        }
        
        //一覧ページを表示する（変数itemsとtabをviewに渡す）
        return view('profiles', compact('items', 'profiles', 'page'));
    }

    public function profileEdit()
    {
        //現在認証しているユーザーを取得
        $user = Auth::user();
        //変数profilesは認証ユーザーのprofile
        $profiles = $user->profile;
        //「auth.profile」を表示（変数userをauth.profileに渡す）
        return view('auth.profile', compact('user', 'profiles'));
    }

    public function profileUpdate(ProfileRequest $request)
    {
        //現在認証しているユーザーを取得
        $user = Auth::user();
        //変数profilesは認証ユーザーのprofileのデータを格納する
        $profiles = $user->profile;
        //viewより呼び出した[user_id][name][image][post][address][building]を$profilesに格納する。
        $profiles = $request->only(['user_id', 'image', 'name', 'post', 'address', 'building']);
        //idを元にデータを呼びだし、呼び出したデータ（$profiles）をProfileモデルを元にupdateする
        Profile::find($request->id)->update($profiles);
        ////選択されたfileを名前を付けてstorageのimagesディレクトリに保存
        if($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs('profiles', $filename, 'public');

            $profiles['image'] = $filename;
        }
        Profile::find($request->id)->update($profiles);
        //route(items.purchase)にリダイレクトする（変数user,profiles,itemsをviewに渡す）
        return redirect()->route('profile.index')->with(compact('user', 'profiles'));
    }
}
