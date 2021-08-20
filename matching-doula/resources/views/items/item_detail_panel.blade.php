<div class="font-weight-bold text-center pb-3 pt-3" style="font-size: 24px">{{$item->name}}</div>

<div class="row">
    <div class="col-4 offset-1">
        <img class="card-img-top" src="{{ Storage::disk('s3')->url("item-images/$item->image_file_name")}}">
    </div>
    <div class="col-6">
        <table class="table table-bordered">
            <tr>
                <th>出品者</th>
                <td>
                    <!-- ここでN+1問題起きている気がするが実際は起きていない -->
                    <!-- 全てblongsToであるため多対一の関係性のため発行されるクエリは一つ-->
                    <!-- もしここでUser → items → item のような場合はN+1問題が発生する-->
                    @if (!empty($item->seller->avatar_file_name))
                    <?php $seller_avatar_image = $item->seller->avatar_file_name ?>
                    <img src="{{ Storage::disk('s3')->url("avatars/$seller_avatar_image")}}" class="rounded-circle" style="object-fit: cover; width: 35px; height: 35px;">
                    @else
                        <img src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 35px; height: 35px;">
                    @endif
                    <a href="{{ route('seller', ['item' => $item]) }}">
                    {{$item->seller->name}}</a>
                </td>
            </tr>
            <tr>
                <th>エリア</th>
                <td>{{$item->prefecture->name}}</td>
            </tr>
            <tr>
            <tr>
                <th>カテゴリー</th>
                <!-- ここでN+1問題起きている気がするが実際は起きていない -->
                <!-- ここでN+1問題起きている気がする -->
                <td>{{$item->secondaryCategory->primaryCategory->name}} / {{$item->secondaryCategory->name}}</td>
            </tr>
            <tr>
                <th>商品の状態</th>
                <td>{{$item->condition->name}}</td>
            </tr>
            <tr>
                <th>Zoom相談</th>
                <td>{{$item->zoom}}</td>
            </tr>
        </table>
        {{-- ここにいいね機能を実装する --}}
        <div id="app" class="text-center">
            <article-like
                :initial-is-liked-by='@json($item->liked_by_user)'
                :initial-count-likes='@json($item->likes_count)'
                :authorized='@json(Auth::check())'
                endpoint="{{ route('item.like', ['item' => $item]) }}"
            >
            </article-like>
        </div>
    </div>
</div>

<div class="font-weight-bold text-center pb-3 pt-3" style="font-size: 24px">
    <i class="fas fa-yen-sign"></i>
    <span class="ml-1">{{number_format($item->price)}}</span>
</div>
