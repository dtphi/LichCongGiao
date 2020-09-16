@extends('layouts.admin.private')

@section('content')
    <!-- Breadcrumb-->
    {{Breadcrumbs::render($breadcrumb['name'], $breadcrumb)}}
    <!-- Contents-->
    <div class="container-fluid">
        <div class="animated fadein">
            @component('admin.components.link_back_url', ['link' => $backUrl, 'text' => 'ユーザー一覧に戻る']) @endcomponent
            <div class="row justify-content-center">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-main">
                                <div class="d-flex justify-content-between align-items-center card-header">
                                    <h3><i class="fas fa-users mr10"></i>ユーザー情報詳細</h3>
                                </div>
                                <div class="pt30 card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form class="form-horizontal" action="{{$submitForm}}" method="post" id="form-user" accept-charset="utf-8">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{$member['id']}}">
                                                <div class="form-group validateGroup row mb-2"><label class="col-form-label col-sm-3">ユーザーID</label>
                                                    <div class="col-sm-6">
                                                        <p class="form-control-static">{{$member['id']}}</p>
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="name_kana">名前カナ<span class="badge badge-danger ml-2">必須</span></label>
                                                    <div class="col-sm-8">
                                                        <div class="error-tip">
                                                            <div class="error-tip-inner"></div>
                                                        </div><input class="form-control validate name_kana" type="text" name="name_kana" id="name_kana" data-validate="empty katakana" value="{{$member['nameKana']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="email">メールアドレス<span class="badge badge-danger ml-2">必須</span></label>
                                                    <div class="col-sm-8">
                                                        <div class="error-tip">
                                                            <div class="error-tip-inner"></div>
                                                        </div><input class="form-control validate email" type="email" name="email" id="email" data-validate="empty email" value="{{$member['email']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="password">パスワード<span class="badge badge-success ml-2">任意</span></label>
                                                    <div class="col-sm-8">
                                                        <div class="error-tip">
                                                            <div class="error-tip-inner"></div>
                                                        </div><input class="form-control validate password" type="password" name="password" id="password" placeholder="8文字以上" data-validate="" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label">組織・権限<span class="badge badge-danger ml-1">必須</span></label>
                                                    <div class="col-sm-3"><select class="form-control validate get-base organization_id validate" id="organization_id" name="organization_id" data-validate="empty">
                                                            @foreach($orgs as $key=>$org)
                                                                @if(!empty($org))
                                                                <option value="{{($key) ? $key: ''}}" @if($key == $member['organizationId']) selected="selected" @endif>{{$org}}</option>
                                                                @endif
                                                                @endforeach
                                                        </select></div>
                                                </div>
                                                <div class="form-group validateGroup row mb-2"><label class="col-form-label col-sm-3">所属事務局名</label>
                                                    <div class="col-sm-6">
                                                        <p class="form-control-static">{{$member['baseName']}}</p>
                                                    </div>
                                                </div>
                                                <h3 class="heading heading-card-divider">テスト</h3>
                                                <table class="table table-main table-small" id="user">
                                                    <thead>
                                                        <tr>
                                                            <th>テスト名</th>
                                                            <th>受験日</th>
                                                            <th>状況</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($memberExams as $memberExam)
                                                            <tr>
                                                                <td>{{$memberExam['examTitle']}}</td>
                                                                <td>{{$memberExam['testDateText']}}</td>
                                                                <td>{{$memberExam['passedText']}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <h3 class="heading heading-card-divider">状態</h3>
                                                <div class="form-group validateGroup row mb-2"><label class="col-form-label col-sm-3">最終ログイン日時</label>
                                                    <div class="col-sm-6">
                                                        <p class="form-control-static">{{$member['lastLoginDate']['date']. ' ' . $member['lastLoginDate']['time']}}</p>
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label">行動履歴<span class="badge badge-danger ml-1">必須</span></label>
                                                    <div class="col-sm-8">
                                                        <div class="row">
                                                            <div class="col-sm-12"><a class="mt10 btn btn-primary" href="{{$member['hrefActivity']}}">行動履歴を確認する</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label">有効・無効設定<span class="badge badge-danger ml-1">必須</span></label>
                                                    <div class="col-sm-8">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="custom-control custom-radio custom-control-inline"><input class="custom-control-input input-radio" id="status_active" name="status" value="1" @if($member['status'] == 1) checked @endif type="radio"><label class="custom-control-label" for="status_active">有効</label></div>
                                                                <div class="custom-control custom-radio custom-control-inline"><input class="custom-control-input input-radio" id="status_inactive" name="status" value="0" type="radio" @if($member['status'] == 0) checked @endif><label class="custom-control-label" for="status_inactive">無効</label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @component('admin.components.input_back_url', ['value' => $strQuery]) @endcomponent
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @component('admin.components.btn_update_form', ['id' => 'form-user'])@endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @component('admin.components.link_back_url', ['link' => $backUrl, 'text' => 'ユーザー一覧に戻る']) @endcomponent
        </div>
    </div>

    @if ($errors)
        <!-- Modal -->
		@include('modals.admin.error_user')
	@endif
@endsection
