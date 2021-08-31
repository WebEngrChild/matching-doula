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

『メルカリ』『ラクモ』では出品者情報が十分でない方が数多く出品しています。実際、私もメルカリでベビーカーを購入しましたが出品者の対応の悪さや商品の質の悪さなど満足度は低いものでした。
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

- **クレジット決済機能**
- **商品購入後のプライベートチャット機能(broadcast/event、vue.js)**
- **チャット通知機能**
- **Zoomミーティング生成（Zoom API）**

## ER図

<img width="585" alt="ER図" src="https://user-images.githubusercontent.com/87892265/131296654-a8f128f9-bf27-4794-b36d-9c598920ca6e.png">

## 使用技術
- **バックエンド**
  - php
  - Laravel

- **フロントエンド**
  - HTML/CSS/Sass/JavaScript
  - jQuery
  - vue.js

- **インフラ**
  - AWS(EC2 VPC IAM RDS Route53 CloudFormation S3)
  - Docker / docker-compose
  - Circle CI
  - mysql
  
 - **その他ツール**
  - Postman(APIの検証・生成・取得に使いました)
  - MySQLWorkbench(データベースやAWSの構成図に使いました)
  - phpUnit
 
## インフラ構成図

![スクリーンショット 2021-08-30 15 22 36](https://user-images.githubusercontent.com/87892265/131294563-eb868380-5dfd-4041-b109-3700942eaee4.png)

## こだわりポイント（実装に苦労した点）

**①商品購入後のプライベートチャット機能**

購入後には売り手・買い手双方でのやりとりが行えるチャット機能を実装しました。ユーザーがよりスムーズに操作できるようにVue.jsのaxiosを使った非同期通信でサーバーに接続できるように設定しています。商品売買者のみが本機能を利用できるようbroadcast/eventを用いております。また通知機能も実装しているためすぐに相手からの反応を確認することができます。

**②ZoomAPIを用いたMeeting生成機能**

対面での相談や商品サポートなどでZoomを活用できるようにZoomAPIを用いて上記チャット内で簡単にミーティングを作成できるようになっています。認証方法はJWTを用いており実際にトークンを作成して理解を深めるようにしました。

**③AWS S3への画像保存**

本アプリのインフラ基盤はAWSを用いております。マッチング・ドゥーラでは出品商品やユーザープロフィールなどで画像登録機能が数多く実装されていますが保存先はS3となっております。

## 今後追加していきたい機能

- 既存コードのリファクタリング
- レスポンシブ対応
- 無形出品の際は何度でも購入可能
- メッセージ通知機能を非同期通信化