@extends('layouts.app')
@section('title')
Meeting設定フォーム
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 offset-1 bg-white">
            <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">Zoomを設定する</div>
        <form method="post" action="{{route('mypage.make-zoom', [$messageroom->id])}}">
            @csrf

            @if(isset($error))
            <div class="alert alert-danger mb-3" role="alert">
                入力項目に誤りがあります。ご確認の上、もう一度送信をお願いします。
            </div>
            @endif

            <div class="mb-3">
                <label for="startAt" class="form-label">ミーティング開始日時</label>
                <input type="datetime-local" name="startAt" class="form-control" id="startAt" placeholder="name@example.com">
                @if(isset($error['companyname']))<p class="err">{{$error['companyname'][0]}}</p>@endif
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">ご相談内容<span class="err"> *入力必須</span></label>
                <textarea name="content" class="form-control" id="content" rows="3"></textarea>
                <small>1000文字以内でご入力ください。</small>
                @if(isset($error['companyname']))<p class="err">{{$error['companyname'][0]}}</p>@endif
            </div>

            <div class="col-auto">
                <button type="submit" class="submit-btn btn btn-primary btn-lg">送信</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
