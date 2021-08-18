@extends('layouts.app')

@section('title')
    出品者
@endsection

@section('content')
<div class="row">
    <div class="col-8 offset-2 bg-white">
        <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">プロフィール</div>
            <div class="container text-center">
                <span class="avatar-form image-picker">
                    @if (!empty($user->avatar_file_name))
                    <img src="{{ Storage::disk('s3')->url("avatars/$user->avatar_file_name")}}" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                    @else
                    <img src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                    @endif
                </span>
            </div>
            <div class="container text-center">
                <p>ニックネーム</p>
                <p>{{ $user->name }}</p>
            </div>
            <div class="container text-center">
                <p>私のこれまでの経験</p>
                <p>{{ $user->activities }}</p>
            </div>
            <div class="container text-center">
                <p>寄り添いメッセージ</p>
                <p>{{ $user->messages }}</p>
            </div>
        </div>
    </div>
@endsection
