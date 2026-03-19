@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" >
@endsection

@section('content')
<div class="item_content">
    <div class="item_content-search">
        <span class="list_label">おすすめ</span>
        <span class="list_label">マイリスト</span>
    </div>
    <div class="item_list">
        <div class="row row-cols-1 row-cols-md-4">
            @foreach($items as $item)
            <div class="col">
                <a href="/item/{{ $item['id'] }}">
                    <div class="item_image">
                        <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}">
                    </div>
                    <div class="item_label">
                        <p>{{ $item('name') }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection