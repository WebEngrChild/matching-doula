@extends('layouts.app')

@section('title')
    {{$item->name}} | 商品詳細
@endsection

@section('content')
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

            {{-- 別のbladeを読み込む --}}
            @include('items.item_detail_panel', [
                'item' => $item
            ])

            <div class="row">
                <div class="col-8 offset-2">
                    @if ($item->isStateSelling)
                        <a href="{{route('item.buy', [$item->id])}}" class="btn btn-secondary btn-block">購入</a>
                    @else
                        <button class="btn btn-dark btn-block" disabled>売却済み</button>
                    @endif
                </div>
            </div>

            <div class="my-3">{!! nl2br(e($item->description)) !!}</div>

            <div class="row">
                <div class="col-8 offset-2">
                    <form method="POST" action="{{ route('mypage.make-zoom',[$item->message_room_id]) }}" class="p-2" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn btn-secondary text-white btn-block" {{$item->zoom === 'なし' ? 'disabled' : ''}}>
                            Meetingルームを作成
                        </button>
                    </form>
                        <message-room
                        :message-Room-Id='@json($item->message_room_id)'
                        :auth-User='@json($user->name)'
                        ></message-room>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
