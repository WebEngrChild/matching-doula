# マッチング・ドゥーラ

出産育児を経験したママさんが集うフリマアプリになります。

![マッチング・ドゥーラ画像](https://user-images.githubusercontent.com/87892265/131450011-37247afc-948a-47de-8b4f-5382b2cf48e2.png)

[マッチング・ドゥーラ](https://matching-doula.com/)

## サービス概要
**◆出産育児経験のある方が商品を売買できます（購入者メリット）**

メルカリやラクマのような総合フリマサイトではなく、特化型のフリマサイトになります。このアプリでは出品者は『全員出産・育児経験者のみ』『プロフィール（写真あり）記入必須』となっているため、安心して購入することができます。

**◆有形だけでなく無形のサービスも出品することができます（出品者メリット）**

出産・育児の経験は見過ごされがちですが非常に価値の高いものです。本アプリではメッセージのやりとりやZoomでのちょっとした相談さえも価値をつけて出品するこができます。
   
**◆自分自身の経験を商品に付与することで値下げ競争から脱することができます（運営者メリット）**

これまでのフリマアプリは同じ商品の出品数が増加するに伴い、市場価格が低減するという手数料ビジネスにおける大きなボトルネックが発生します。一方で本アプリでは既存サービスに”チャット”や”対面でのトーク”を組み合わせることで価格の下落圧力から脱することができます。

## なぜ作ったか

自分自身の実体験も踏まえて以下の三つの課題感から本アプリの作成を決めました。

**①出産育児関連の商品購入の家計への負担**

ミルク、洋服、ベビーカー等、初期費用はかなり家計を圧迫します。フリマで中古品等で値段を安く抑えることができればパパママの負担を減らすことができます。

**②既存のフリマアプリでのトラブル**

『メルカリ』『ラクモ』では出品者情報が十分でない方が数多く出品しています。実際、私もメルカリでベビーカーを購入しましたが出品者の対応の悪さやマニュアル不備で使い方がわからない、など満足度は低いものでした。
これまでのフリマでは『商品の売買』が注目されていますが、このアプリでは『助け合い』の精神のもと出品者の方のプロフィール情報登録（写真あり）は必須になっています。

**③出産育児経験者の重要性**

出産・育児の経験は見過ごされがちですが非常に価値の高いものだと思っています。例えば、出産後のママさんの不安定な状況は『うんうん。そうだね』と共感するだけでも気持ちをリラックスさせることができます。本アプリではチャットやZoomでの相談も出品することができます。

## 機能一覧
- **認証機能**
  - ログイン
  - ロウアウト機能
  - ユーザー登録

- **CRUD機能**
  - 商品出品
  - 出品商品編集
  - プロフィール編集

- **複数条件検索機能**
  - エリア別
  - カテゴリー別
  - フリーキーワード

- **お気に入り機能（Vue.js）**
  - 商品毎
  - ユーザー毎のお気に入り獲得ランキング

- **クレジット決済機能(Pay.JP)**
- **商品購入後のプライベートチャット機能(pusher/broadcast/event、vue.js)**
- **チャット通知機能**
- **Zoomミーティング生成（Zoom API）**

## ER図

<img width="581" alt="ER図修正" src="https://user-images.githubusercontent.com/87892265/132439021-a0f0f5b2-0374-4bc0-a0da-891a06c5e231.png">

## 使用技術
- **バックエンド**
  - php 7.2.5
  - Laravel 7.24

- **フロントエンド**
  - HTML/CSS/Sass/JavaScript
  - jquery 3.2
  - bootstrap 4.0.0
  - bootstrap-vue 2.21.2
  - vue.js 2.5.17

- **インフラ**
  - AWS(EC2 VPC IAM RDS Route53 CloudFormation S3)
  - Laradock / Docker 20.10.6 / docker-compose 1.29.1
  - Circle CI
  - mysql 5.7
  
 - **その他ツール**
  - ZoomAPI
  - laravel-echo 1.11.1
  - payjp/payjp-php 1.2.0
  - pusher/pusher-php-server 4.0
  - MySQLWorkbench
  - Postman
 
## インフラ構成図

![スクリーンショット 2021-08-30 15 22 36](https://user-images.githubusercontent.com/87892265/131294563-eb868380-5dfd-4041-b109-3700942eaee4.png)

## こだわりポイント（実装に苦労した点）

**①商品購入後のプライベートチャット機能**

購入後には売り手・買い手双方で連絡が行えるチャット機能を実装しました。ユーザーがよりスムーズに操作できるように非同期通信で実装しています。さらに通知機能（Newというタグが表示）も実装しているため相手からの反応を漏れることなく確認することができます。ネット上には『誰でもアクセス可能』あるいは『ログインしているユーザーのみ』といった情報しかなかったため、『売り手と買い手』のみがメッセージのやりとりができるよう実装を工夫しました。

《実装内容》
 - メッセージ送信時にEventを作成しBroadcasting
 - PusherとPusherチャンネルPHP SDKを利用したWebSocket接続
 - フロント側はVue.js。axiosを使って非同期通信処理でメッセージ取得/送信を行う
 - 商品購入時に生成されるmessage_roomsテーブルのIDをもとにプライベートチャンネルを設定。売り手と買い手以外にメッセージが表示されないよう設計
 - middlewareで売り手と買い手以外のユーザーがメッセージルーム入室 or 送信ができないよう設計

**②ZoomAPIを用いたMeeting生成機能**

対面での相談や商品サポートなどでZoomを活用できるようにZoomAPIを用いて上記チャット内で簡単にミーティングを作成できるようになっています。認証方法はJWTを用いており実際にトークンを作成して理解を深めるようにしました。

[【Laravel×ZOOM API】JSON Web Tokensを自分で作成して実装してみた（JWTトークン編）](https://qiita.com/joe-main/items/864c79b8f35c202b099b)

[【Laravel×ZOOM API】JSON Web Tokensを自分で作成して実装してみた（APIリクエスト編）](https://qiita.com/joe-main/items/2cc678640ecd0d6dd0d0)

**③AWS S3への画像保存**

本アプリのインフラ基盤はAWSを用いております。マッチング・ドゥーラでは出品商品やユーザープロフィールなどで画像登録機能が数多く実装されていますが保存先はS3となっております。

[Qiita【AWS S3 × Laravel】画像アップロード先をS3に変更した際に発生したエラーと解決までの道のり（nginxデバッグ対応）](https://qiita.com/joe-main/items/bba9bcd6923b93399393)

## 今後追加していきたい機能

- 既存コードのリファクタリング
- レスポンシブ対応
- 無形出品の際は何度でも購入可能
- メッセージ通知機能を非同期通信化
- Zoomスケジューリング機能