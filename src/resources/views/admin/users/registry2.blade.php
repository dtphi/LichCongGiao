@extends('layouts.admin.private')

@section('content')
    <!-- Breadcrumb-->
    {{Breadcrumbs::render($breadcrumb['name'], $breadcrumb)}}
    <!-- Contents-->
    <div class="container-fluid">
        <div class="animated fadein">
            <div class="d-flex justify-content-between mt15 block"><a class="anchor anchor-chevron-left" href="/user">ユーザー一覧に戻る</a></div>
            <div class="row justify-content-center">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-main">
                                <div class="d-flex justify-content-between align-items-center card-header">
                                    <h3><i class="fas fa-users mr10"></i>ユーザー新規作成</h3>
                                </div>
                                <div class="pt30 card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form class="form-horizontal" action="{{route('admin.user.registry')}}" method="post" id="form-user" accept-charset="utf-8">
                                                @csrf
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="name_kana">名前カナ<span class="badge badge-danger ml-2">必須</span></label>
                                                    <div class="col-sm-8">
                                                        <div class="error-tip">
                                                            <div class="error-tip-inner"></div>
                                                        </div><input class="form-control validate name_kana" type="text" name="name_kana" id="name_kana" placeholder="" data-validate="empty katakana" value="{{$formData['name_kana']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="email">メールアドレス<span class="badge badge-success ml-2">任意</span></label>
                                                    <div class="col-sm-8">
                                                        <div class="error-tip">
                                                            <div class="error-tip-inner"></div>
                                                        </div><input class="form-control validate email" type="email" name="email" id="email" placeholder="" data-validate="empty email" value="{{$formData['email']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="password">パスワード<span class="badge badge-danger ml-2">必須</span></label>
                                                    <div class="col-sm-8">
                                                        <div class="error-tip">
                                                            <div class="error-tip-inner"></div>
                                                        </div><input class="form-control validate password" type="password" name="password" id="password" placeholder="8文字以上" data-validate="empty alnum nospace min-8">
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label">組織・権限<span class="badge badge-danger ml-1">必須</span></label>
                                                    <div class="col-sm-3"><select class="form-control validate get-base organization_id validate" id="organization_id" name="organization_id" data-validate="empty">
                                                            @foreach($orgs as $key=>$org)
                                                                @if(!empty($org))
                                                                <option value="{{($key) ? $key: ''}}" @if($key == $formData['organization_id']) selected="selected" @endif>{{$org}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select></div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label">所属事務局名<span class="badge badge-success ml-1">任意</span></label>
                                                    <div class="col-sm-3">
                                                        <div class="base-select-wrap"></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @component('admin.components.btn_create_form', ['id' => 'form-user'])@endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt15 mb30 block"><a class="anchor anchor-chevron-left" href="/user">ユーザー一覧に戻る</a></div>
        </div>
    </div>

    @if ($errors)
        <!-- Modal -->
		@include('modals.admin.error_user')
	@endif
@endsection
