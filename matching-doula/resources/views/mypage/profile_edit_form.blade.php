@extends('layouts.app')

@section('title')
    プロフィール編集
@endsection

@section('content')
    <div id="profile-edit-form" class="container">
        <div class="row">
            <div class="col-8 offset-2">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-8 offset-2 bg-white">

                <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">プロフィール編集</div>

                <form method="POST" action="{{ route('mypage.edit-profile') }}" class="p-5" enctype="multipart/form-data">
                    @csrf

                    {{-- アバター画像 --}}
                    <span class="avatar-form image-picker">
                        <input type="file" name="avatar" class="d-none" accept="image/png,image/jpeg,image/gif" id="avatar" />
                        <label for="avatar" class="d-inline-block">
                            @if (!empty($user->avatar_file_name))
                                <img src="{{ Storage::disk('s3')->url("avatars/$user->avatar_file_name")}}" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                            @else
                                <img src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                            @endif
                        </label>
                    </span>

                    {{-- ニックネーム --}}
                    <div class="form-group mt-3">
                        <label for="name">ニックネーム</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- 活動の説明 --}}
                    <div class="form-group mt-3">
                        <label for="activities">私のこれまでの経験</label>
                        <textarea id="activities" class="form-control @error('activities') is-invalid @enderror" name="activities" value="{{ old('activities', $user->activities) }}" required autocomplete="activities" autofocus>{{ old('activities',  $user->activities) }}</textarea>
                        @error('activities')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- 寄り添いメッセージ  --}}
                    <div class="form-group mt-3">
                        <label for="messages">寄り添いメッセージ</label>
                        <textarea id="messages" class="form-control @error('messages') is-invalid @enderror" name="messages" value="{{ old('messages', $user->messages) }}" required autocomplete="messages" autofocus>{{ old('messages', $user->messages) }}</textarea>
                        @error('messages')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    {{-- 私の活動画像1 --}}
                    <div class="row">
                        <div class="col-4  bg-white">
                                <span class="activity-image-form image-picker">
                                    <input type="file" name="activity_image1" class="d-none" accept="image/png,image/jpeg,image/gif" id="activity_image1" />
                                    <label for="activity_image1" class="d-inline-block">
                                        @if (!empty($user->activity_image_file_name_1))
                                            <img  id="first" src="{{ Storage::disk('s3')->url("activity_images/$user->activity_image_file_name_1")}}" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                                        @else
                                            <img  id="first" src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                                        @endif
                                    </label>
                                </span>
                            </div>
                        <div>
                    </div>

                    {{-- 私の活動画像2 --}}
                    <div class="col-4  bg-white">
                        <span class="activity-image-form image-picker">
                            <input type="file" name="activity_image2" class="d-none" accept="image/png,image/jpeg,image/gif" id="activity_image2" />
                            <label for="activity_image2" class="d-inline-block">
                                @if (!empty($user->activity_image_file_name_2))
                                    <img  id="second" src="{{ Storage::disk('s3')->url("activity_images/$user->activity_image_file_name_2")}}" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                                @else
                                    <img  id="second" src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                                @endif
                            </label>
                        </span>
                    </div>

                    {{-- 私の活動画像3 --}}
                    <div class="col-4 bg-white">
                        <span class="activity-image-form image-picker">
                            <input type="file" name="activity_image3" class="d-none" accept="image/png,image/jpeg,image/gif" id="activity_image3" />
                            <label for="activity_image3" class="d-inline-block">
                                @if (!empty($user->activity_image_file_name_3))
                                    <img id="third" src="{{ Storage::disk('s3')->url("activity_images/$user->activity_image_file_name_3")}}" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                                @else
                                    <img id="third" src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                                @endif
                            </label>
                        </span>
                    </div>
                 </div>
                    <div class="form-group mb-0 mt-3">
                        <button type="submit" class="btn btn-secondary text-white btn-block">
                            保存
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

