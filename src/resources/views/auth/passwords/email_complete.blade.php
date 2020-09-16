@extends('layouts.admin.auth')

@section('content')
    <div class="container-fluid">
        <div class="animated fadein">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-main card-company">
                            <div class="d-flex justify-content-between align-items-center card-header">
                                <h3><i class="fas fa-envelope mr-2"></i>メール送信完了</h3>
                            </div>
                            <div class="card-body">
                                <p class="tac fwb fs18 mt30 text">ご入力いただいたアドレスにメールを送信しました。<br>メール内のURLをクリックして新しいパスワードを設定してください。</p>
                                <div class="pt-4 pb-4 block block-center"><a class="mt-4 mb-2 btn btn-main btn-lg" href="{{route('login')}}">ログイン画面へ<i class="fas fa-chevron-right ml-2"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
