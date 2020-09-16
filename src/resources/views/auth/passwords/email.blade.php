@extends('layouts.admin.auth')

@section('content')
    <div class="container-fluid">
        <div class="animated fadein">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-main card-forget">
                            <div class="d-flex justify-content-between align-items-center card-header">
                                <h3><i class="fas fa-envelope mr-2"></i>パスワードを忘れた</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" action="{{route('password.request.exec')}}" method="post" id="form-forget" accept-charset="utf-8">
                                    @csrf
                                    <p class="mb20 text">ご登録いただいたメールアドレスを入力するとパスワード再設定のメールが送信されます。<br>メール内のURLをクリックするとパスワードが再設定できます。</p>
                                    <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="email">メールアドレス<span class="badge badge-danger ml-2">必須</span></label>
                                        <div class="col-sm-8">
                                            <div class="error-tip">
                                                <div class="error-tip-inner"></div>
                                            </div><input class="form-control validate email" type="email" name="email" id="email" placeholder="" data-validate="empty email" value="">
                                        </div>
                                    </div>
                                    <div class="pt-4 pb-4 block block-center"><button class="mt-4 mb-2 btn btn-main btn-lg" type="submit" data-form="#form-forget"><i class="fas fa-envelope mr-2"></i>メール送信<i class="btn-caret"></i></button></div>
                                </form>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb15 block"><a class="anchor anchor-chevron-left" href="{{route('login')}}">ログイン画面に戻る</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->all())
        <!-- Modal -->
		@include('modals.auth.passwords.error_forget')
	@endif

@endsection
