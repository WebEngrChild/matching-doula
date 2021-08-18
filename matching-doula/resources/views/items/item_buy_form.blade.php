@extends('layouts.app_payjp')

@section('title')
    {{$item->name}} | 商品購入
@endsection

@section('content')
{{-- PAY.JPのライブラリを読み込む --}}
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

        {{-- クレジットカード情報を入力するフォームはPAY.JPのライブラリを組み込むことで初めて動作するようになります。 --}}
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card-form-alert alert alert-danger" role="alert" style="display: none"></div>
                    <div class="form-group mt-3">
                        <label for="number-form">カード番号</label>
                        <div id="number-form" class="form-control"><!-- ここにカード番号入力フォームが生成されます --></div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="expiry-form">有効期限</label>
                        <div id="expiry-form" class="form-control"><!-- ここに有効期限入力フォームが生成されます --></div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="expiry-form">セキュリティコード</label>
                        <div id="cvc-form" class="form-control"><!-- ここにCVC入力フォームが生成されます --></div>
                    </div>
                </div>
            </div>

            <div class="row mt-3 mb-3">
                <div class="col-8 offset-2">
                    {{-- カードトークン取得 --}}
                    <button class="btn btn-secondary text-white btn-block" onclick="onSubmit(event)">購入</button>
                </div>
            </div>

            <form id="buy-form" method="POST" action="{{route('item.buy', [$item->id])}}">
                @csrf
                <input type="hidden" id="card-token" name="card-token">
            </form>
        </div>
    </div>
</div>

<script>
    // カード情報入力フォームの構築
    var payjp = Payjp('{{config("payjp.public_key")}}')

    var elements = payjp.elements()

    var numberElement = elements.create('cardNumber')
    var expiryElement = elements.create('cardExpiry')
    var cvcElement = elements.create('cardCvc')
    numberElement.mount('#number-form')
    expiryElement.mount('#expiry-form')
    cvcElement.mount('#cvc-form')

    //イベント送信用のメソッド
    //購入ボタンをクリックした際に、カード情報をPAY.JPサーバに送信し、カードトークンを取得した後、フォームを送信submitしています。
    function onSubmit(event) {
          const msgDom = document.querySelector('.card-form-alert');
          msgDom.style.display = "none";
          payjp.createToken(numberElement).then(function(r) {

              if (r.error) {
                  msgDom.innerText = r.error.message;
                  msgDom.style.display = "block";
                  return;
              }

              document.querySelector('#card-token').value = r.id;
              document.querySelector('#buy-form').submit();
          })
      }
</script>
@endsection
