@extends('layouts.app_payjp')

@section('title')
    {{$item->name}} | 商品購入
@endsection

@section('content')
{{-- PAY.JPのクライアントサイド向けのライブラリを読み込む --}}
<script src="https://js.pay.jp/v2/pay.js"></script>
<div class="container">
    <div class="row">
        <div class="col-8 offset-2 bg-white">
            <div class="row mt-3">
                <div class="col-8 offset-2">
                    @if (session('message'))
                        <div class="alert alert-{{ session('type', 'success') }}" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>

            @include('items.item_detail_panel', [
                'item' => $item
            ])

        {{-- クレジットカード情報を入力するフォームはPAY.JPのライブラリを組み込むことで動作 --}}
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card-form-alert alert alert-danger" role="alert" style="display: none"></div>
                    <div class="form-group mt-3">
                        <label for="number-form">カード番号　（4242 4242 4242 4242）</label>
                        <div id="number-form" class="form-control"><!-- ここにカード番号入力フォームが生成 --></div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="expiry-form">有効期限　（11 / 99）</label>
                        <div id="expiry-form" class="form-control"><!-- ここに有効期限入力フォームが生成 --></div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="expiry-form">セキュリティコード （999）
                        </label>
                        <div id="cvc-form" class="form-control"><!-- ここにCVC入力フォームが生成 --></div>
                    </div>
                </div>
            </div>

            <div class="row mt-3 mb-3">
                <div class="col-8 offset-2">
                    {{-- 購入ボタンを押下でカード情報をPAY.JPサーバに送信してカードトークン取得 --}}
                    <button class="btn btn-secondary text-white btn-block" onclick="onSubmit(event)">購入</button>
                </div>
            </div>

            <form id="buy-form" method="POST" action="{{route('item.buy', [$item->id])}}">
                @csrf
                {{-- formタグの中に、あらかじめ以下のinputタグを用意 --}}
                <input type="hidden" id="card-token" name="card-token">
            </form>
        </div>
    </div>
</div>

<script>
    // Payjpクラスのインスタンス取得
    var payjp = Payjp('{{config("payjp.public_key")}}')

    //カード情報入力フォームを構築するためのインスタンス
    var elements = payjp.elements()

    //createメソッドで、指定した種類のElementインスタンスを生成
    var numberElement = elements.create('cardNumber')
    var expiryElement = elements.create('cardExpiry')
    var cvcElement = elements.create('cardCvc')

    //mountメソッドで各種入力欄をDOM上に配置
    numberElement.mount('#number-form')
    expiryElement.mount('#expiry-form')
    cvcElement.mount('#cvc-form')

    //イベント送信用のメソッド
    //購入ボタンをクリックした際にカード情報をPAY.JPサーバに送信、カードトークンを取得した後、フォームを送信submit
    function onSubmit(event) {
          const msgDom = document.querySelector('.card-form-alert');
          msgDom.style.display = "none";

          //PAY.JPサーバにカード情報を送信し、カードトークンを取得
          payjp.createToken(numberElement).then(function(r) {

              if (r.error) {
                  msgDom.innerText = r.error.message;
                  msgDom.style.display = "block";
                  return;
              }

              //CSSセレクタでidがcard-tokenのDOMを検索し、value属性にカードトークンを設定
              document.querySelector('#card-token').value = r.id;

              //フォーム送信
              document.querySelector('#buy-form').submit();
          })
      }
</script>
@endsection
