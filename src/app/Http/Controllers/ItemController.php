<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Profile;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ExhibitionRequest;

class ItemController extends Controller
{   //一覧ページを表示メソッド
    public function index(Request $request)
    {
        //変数userIdはAuthファサードからログインIdとする
        $userId = Auth::id();
        //変数tabはtabとrecommendのどちらか選択した方を呼び出す。
        $tab = $request->query('tab', 'recommend');
        //変数itemsはItemモデルとOrderモデルのデータを取得する。
        $items = Item::with('order')->get();
        //変数itemsの呼び出し方
        $items = [];
        //myListを選択した時
        if ($tab === 'myList') {
            //変数likeItemIdsはLikeモデルに認証中のuser_idとitem_idの二つが登録された商品データを格納する
            $likeItemIds = Like::where('user_id', Auth::id())->pluck('item_id')->toArray();
            //変数itemsは「いいね」した商品データを取得する
            $items = Item::whereIn('id', $likeItemIds)->paginate(15);
        }else {
            //変数itemsは「認証userが出品した商品以外のデータを取得する
            $items = Item::where('user_id', '!=', $userId)->paginate(15);
        }
        //一覧ページを表示する（変数itemsとtabをviewに渡す）
        return view('index', compact('items', 'tab'));
    }

    public function search(Request $request)
    {
        //変数userIdはAuthファサードからログインIdとする
        $userId = Auth::id();
        $keyword = $request->input('keyword');
        $tab = $request->input('tab', 'recommend');

        $query = Item::query();

        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        if ($tab === 'myList') {
            $items = $query->onlyLikedBy($userId)->paginate(15);
        } else {
            $items = $query->when($userId, function ($q) use ($userId) {

                return $q->excludeUser($userId);
            })
            ->paginate(15);
        }

        return view('index',compact('items', 'tab', 'keyword'));
    }

    public function getMyList()
    {
        return Auth::user()->myListItems;
    }

    //詳細ページを表示するメソッド（選択したitemId）
    public function show($itemId)
    {
        //変数userIdは認証ユーザーのもの
        $userId = Auth::id();
        //変数itemsは選択したitemIdのitemsデータをItemモデルより、[category][condition][profile][likes][comments]のデータを取得（commentはcommentしたuserのプロフィール情報も取得）
        $items = Item::with(['categories', 'condition', 'profile', 'likes', 'comments.profile'])->findOrFail($itemId);
        //詳細ページを表示する（変数itemsをviewに渡す）
        return view('detail', compact('items'));
    }
    //購入ページを表示するメソッド(選択したitemId)
    public function purchase($itemId)
    {
        //変数userIdは認証ユーザーのもの
        $user = Auth::user();
        //変数profilesは認証ユーザーのprofile
        $profiles = $user->profile;
        //変数itemsは選択したitemのデータをItemモデルより取得
        $items = Item::findOrFail($itemId);
        //商品が購入されていた時、リダイレクトし詳細画面を表示
        if ($items->is_sold) {
            return redirect()->route('items.show', $id)->with('error', 'Sold');
        }
        //購入ページを表示する（変数user,profiles,itemsをviewに渡す）
        return view('purchase', compact('user', 'profiles', 'items'));
    }
    //販売ページを表示するメソッド
    public function itemSell()
    {
        //変数userIdは認証ユーザーのもの
        $user = Auth::user();
        //変数profilesは認証ユーザーのprofile
        $profiles = $user->profile;
        //変数itemsはItemモデルを元に[category][condition]のデータを格納する
        $items = Item::with('categories', 'condition')->get();
        //変数categoriesはCategoryモデルを元に,変数conditionsはConditionモデルを元にデータを取得する
        $categories = Category::all();
        $conditions = Condition::all();
        //販売ページを表示する（変数user,profiles,items,categories,conditions）
        return view('sell', compact('user', 'profiles', 'items', 'categories', 'conditions'));
    }
    //販売商品を登録するメソッド（ExhibitionRequestをバリデーションに使用）
    public function sellStore(ExhibitionRequest $request)
    {
        //変数itemsはviewから呼び出した[category_id][condition_id][name][image][content][brand_name][price]を格納する
        $items = $request->only(['condition_id','categories[]', 'name', 'image', 'content', 'brand_name', 'price']);
        //変数itemsの[user_id]は認証ユーザーのuser_idとする
        //変数itemsの[profile_id]は認証ユーザーのuser_idと紐づいたprofileのidとする（データがない時nullを表示）
        $items['user_id'] = Auth::id();
        $items['profile_id'] = auth()->user()->profile->id ?? null;
        //[images]が呼び出された時
        if($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs('items', $filename, 'public');

            $items['image'] = $filename;
        }
        //変数itemsをItemモデルを元に作成する
        Item::create($items);

        $items = Item::with('categories')->latest()->first();

        $items->categories()->sync($request->categories);

        //('/dashboard')にリダイレクトする
        return redirect('/dashboard');
    }
}
