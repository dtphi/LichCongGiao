@extends('layouts.admin.auth')

@section('content')
    <div class="container-fluid">
        <div class="animated fadein">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-main card-passchange">
                            <div class="d-flex justify-content-between align-items-center card-header">
                                <h3><i class="fas fa-lock mr-2"></i>パスワード再設定</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" action="{{ route('passchange.exec') }}" method="post" id="form-passchange" accept-charset="utf-8">
                                    @csrf
                                    <p class="mb20 text">新しいパスワードを入力してください。</p>
                                    <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="password">パスワード<span class="badge badge-danger ml-2">必須</span></label>
                                        <div class="col-sm-8">
                                            <div class="error-tip">
                                                <div class="error-tip-inner"></div>
                                            </div><input class="form-control validate password" type="password" name="password" id="password" placeholder="" data-validate="empty range-8-20 nospace nosymbol">
                                        </div>
                                        <div class="w-100">
                                            <div class="offset-sm-3 col-sm-8">
                                                <p class="form-description">8文字以上20文字以下</p>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="email" value="{{$email}}">
                                    <input type="hidden" name="token" value="{{$token}}">
                                    <div class="pt-4 pb-4 block block-center"><button class="mt-4 mb-2 btn btn-main btn-lg" type="submit" data-form="#form-passchange">パスワード再設定<i class="btn-caret"></i></button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->all())
        <!-- Modal -->
		@include('modals.auth.passwords.error_reset')
	@endif

@endsection
