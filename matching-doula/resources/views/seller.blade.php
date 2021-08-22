@extends('layouts.app')

@section('title')
    出品者
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2 bg-white">
            <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">プロフィール
                </div>
                    <div class="text-center">
                        <span class="avatar-form image-picker">
                            @if (!empty($user->avatar_file_name))
                            <img src="{{ Storage::disk('s3')->url("avatars/$user->avatar_file_name")}}" class="mt-4 rounded-circle" style="object-fit: cover; width: 300px; height: 300px;">
                            @else
                            <img src="/images/avatar-default.svg" class="mt-4 rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                            @endif
                        </span>
                    </div>
                <div class="mt-4 card bg-secondary">
                    <div class="card-header text-white">ニックネーム</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $user->name }}</li>
                </div>
                <div class="mt-1 card bg-secondary">
                    <div class="card-header text-white">私のこれまでの経験</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $user->activities }}</li>
                </div>
                <div class="mt-1 card bg-secondary">
                    <div class="card-header text-white">寄り添いメッセージ</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $user->messages }}</li>
                </div>
                <div class="mt-1 card bg-secondary">
                    <div class="card-header text-white">私の活動</div>
                        <div class="py-4 bg-light">
                        <div class="container">
                            <!-- カルーセル外枠 -->
                            <div id="main_visual" class="carousel slide" data-ride="carousel">
                            <!-- カルーセル内枠 -->
                            <div class="carousel-inner">
                                <!-- スライド01 -->
                                <div class="text-center carousel-item active">
                                    @if (!empty($user->activity_image_file_name_1))
                                         <img src="{{ Storage::disk('s3')->url("activity_images/$user->activity_image_file_name_1")}}" class="img-fluid mt-4 rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                                    @else
                                         <img src="/images/avatar-default.svg" class="img-fluid mt-4 rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                                    @endif
                                </div>
                                <!-- スライド02 -->
                                <div class="text-center carousel-item">
                                    @if (!empty($user->activity_image_file_name_2))
                                         <img src="{{ Storage::disk('s3')->url("activity_images/$user->activity_image_file_name_2")}}" class="img-fluid mt-4 rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                                    @else
                                         <img src="/images/avatar-default.svg" class="img-fluid mt-4 rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                                    @endif
                                </div>
                                <!-- スライド03 -->
                                <div class="text-center carousel-item">
                                    @if (!empty($user->activity_image_file_name_3))
                                         <img src="{{ Storage::disk('s3')->url("activity_images/$user->activity_image_file_name_3")}}" class="img-fluid mt-4 rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                                    @else
                                         <img src="/images/avatar-default.svg" class="img-fluid mt-4 rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                                    @endif
                                </div>
                            <!-- コントローラー -->
                            <a class="carousel-control-prev" href="#main_visual" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">前に戻る</span>
                            </a>
                            <a class="carousel-control-next" href="#main_visual" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">次に進む</span>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
