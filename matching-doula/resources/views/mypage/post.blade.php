@extends('layouts.app')

@section('title')
    Vue.jsサンプル
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-10 offset-1 bg-white">

                <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">Vue.jsサンプル</div>

                <div>
                    <example-component></example-component>
                </div>
            </div>
        </div>
    </div>
@endsection
