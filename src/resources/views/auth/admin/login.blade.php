@extends('layouts.admin.auth')

@section('content')
    <div class="container-fluid">
        <div class="animated fadein">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-main card-login">
                            <div class="d-flex justify-content-between align-items-center card-header">
                                <h3><i class="fas fa-sign-in-alt mr-2"></i>ログイン</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" action="{{ route('post.login') }}" method="post" id="form-login" accept-charset="utf-8">
                                    @csrf
                                    <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="organization_id">組織ID<span class="badge badge-danger ml-2">必須</span></label>
                                        <div class="col-sm-3">
                                            <div class="error-tip">
                                                <div class="error-tip-inner"></div>
                                            </div>
                                            <select class="form-control validate organization_id" name="organization_id" id="organization_id" data-validate="empty">
                                                <option value="">選択してください。</option>
                                                <option value="1">BAT（管理者）</option>
                                                <option value="2">DAG（管理者）</option>
                                                <option value="3">ASP統括（統括）</option>
                                                <option value="4">UISM統括（統括）</option>
                                                <option value="5">ASP事務局責任者（事務局責任者）</option>
                                                <option value="6">UISM事務局責任者（事務局責任者）</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="email">メールアドレス<span class="badge badge-danger ml-2">必須</span></label>
                                        <div class="col-sm-8">
                                            <div class="error-tip">
                                                <div class="error-tip-inner"></div>
                                            </div><input class="form-control validate email" type="email" name="email" id="email" placeholder="" data-validate="empty email">
                                        </div>
                                    </div>
                                    <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="password">パスワード<span class="badge badge-success ml-2">任意</span></label>
                                        <div class="col-sm-8">
                                            <div class="error-tip">
                                                <div class="error-tip-inner"></div>
                                            </div><input class="form-control validate password" type="password" name="password" id="password" placeholder="" data-validate="empty alnum nospace">
                                        </div>
                                    </div>
                                    <div class="pt-4 pb-4 block block-center">
                                        <div class="custom-control custom-checkbox"><input class="custom-control-input input-checkbox" id="auto_login" name="auto_login" value="1" type="checkbox" {{ request()->session()->getOldInput('remember') ? 'checked' : '' }}><label class="custom-control-label" for="auto_login">次回から自動でログインする</label></div><button class="mt-4 mb-2 btn btn-main btn-lg" type="submit" data-form="#form-login"><i class="fas fa-sign-in-alt mr-2"></i>ログイン<i class="btn-caret"></i></button>
                                    </div>
                                </form>
                                <div class="tar block">
                                    <a class="mr24 anchor anchor-caret" href="{{ route('password.reset') }}">パスワードを忘れた方はこちら</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	@if ($errors->all())
        <!-- Modal -->
		@include('modals.auth.admin.error_login')
	@endif

@endsection
