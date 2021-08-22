@extends('layouts.app')

@section('title')
    お気に入り獲得ランキング
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1 bg-white">

                <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">お気に入り獲得ランキング</div>

                @foreach ($users as $user)
                    <div class="d-flex mt-3 border position-relative">
                        <div>
                            @if (!empty($user->avatar_file_name))
                                <img src="{{ Storage::disk('s3')->url("avatars/$user->avatar_file_name")}}" class="img-fluid" style="height: 140px;">
                            @else
                                <img src="/images/avatar-default.svg" class="img-fluid" style="height: 140px;">
                            @endif
                        </div>
                        <div class="flex-fill p-3">
                            <div class="card-title mt-2 font-weight-bold" style="font-size: 20px">{{$user->name}}</div>
                            <div>
                                <span class="ml-1">獲得いいね数{{($user->my_likes_count)}}個</span>
                            </div>
                        </div>
                        <a href="{{ route('seller', [$user]) }}" class="stretched-link"></a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
