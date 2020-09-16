@extends('layouts.admin.private')

@section('content')
    <!-- Breadcrumb-->
    {{Breadcrumbs::render($breadcrumb['name'], $breadcrumb)}}
    <!-- Contents-->
    <div class="container-fluid">
        <div class="animated fadein">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="card card-main">
                        <div class="d-flex justify-content-between align-items-center card-header">
                            <h3><i class="fas fa-users mr10"></i>ユーザー一覧</h3>
                            <div class="block"><a class="btn btn-default" href="{{route('admin.user.registry')}}">ユーザー新規登録</a></div>
                        </div>
                        <div class="pt-0 card-body">
                            <div class="row mt30">
                                <div class="col-12 tar"><a class="anchor anchor-clear-search" href="javascript:void(0);"><i class="fas fa-eraser mr10"></i>検索条件をクリア</a></div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-5 d-flex align-items-center mt10 search-wrap">
                                    <p class="mr10 fwb text">名前カナ</p>
                                    <div class="block"><input class="form-control" type="text" data-search-item="kana" value="{{$nameKana}}"></div>
                                </div>
                                <div class="col-12 col-md-5 d-flex align-items-center mt10 search-wrap">
                                    <p class="w180 mr10 fwb text">メールアドレス</p>
                                    <div class="block"><input class="form-control" type="email" data-search-item="email" value="{{$email}}"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-5 d-flex align-items-center mt10 search-wrap">
                                    <p class="w180 mr10 fwb text">組織</p>
                                    <div class="block"><select class="form-control get-base" data-search-item="organization_id" data-search-type="select">
                                            @foreach($orgs as $key=>$org)
                                                @if(!empty($org))
                                                    <option value="{{($key) ? $key: ''}}" @if($key == $organizationId) selected="selected" @endif>{{$org}}</option>
                                                @endif
                                            @endforeach
                                        </select></div>
                                </div>
                                <div class="col-12 col-md-5 d-flex align-items-center mt10 search-wrap">
                                    <p class="w180 mr10 fwb text">事務局</p>
                                    @if($isSelectBase)
                                        <div class="base-select-wrap block"><select class="form-control validate select2 base_id" id="base_id" data-search-item="base_id" data-search-type="select"><option value="">選択してください</option>
                                                @foreach($bases as $key=>$base)
                                                                <option value="{{$base['id']}}" @if($base['id'] == $baseId) selected="selected" @endif>{{$base['name']}}</option>
                                                                @endforeach
                                            </select></div>
                                     @else
                                        <div class="base-select-wrap block">組織を選択してください</div>
                                     @endif
                                </div>
                                <div class="col-12 col-md-2 mt10"><button class="w100p btn btn-main btn-table-search" type="button"><i class="fas fa-search mr10"></i>検索する</button></div>
                            </div>
                            <div class="mt15 pt15 block block-table-control">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <p class="fs16 text">{{$textPerPage}}</p>
                                        <div class="d-flex align-items-center block"><select class="form-control table-sort w200" data-sort-default="registDateDesc">
                                                @foreach($sorts as $key => $value)
                                                    <option value="{{$key}}" @if($key == $sort) selected="selected" @endif>{{$value}}</option>
                                                @endforeach
                                            </select></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt10">
                                <div class="col-12">
                                    <div class="table-wrap">
                                        <div class="scroll-bar">
                                            <div class="scroll-bar-inner"></div>
                                        </div>
                                        <div class="scroll-box">
                                            <table class="table table-main table-small" id="user">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>名前</th>
                                                        <th>メールアドレス</th>
                                                        <th>ユーザー<br>タイプ</th>
                                                        {{--<th>基本テスト<br>合格状況</th>--}}
                                                        <th>最終ログイン<br>日時</th>
                                                        <th>詳細・編集</th>
                                                        <th>削除</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($lists as $list)
                                                        <tr>
                                                            <td>{{$list['id']}}</td>
                                                            <td>{{$list['name']}}</td>
                                                            <td>{{$list['email']}}</td>
                                                            <td>{{$list['organizationText'][0]}}<br>{{$list['organizationText'][1]}}</td>
                                                            {{--<td>{{$list['passedText']}}</td>--}}
                                                            <td>{{$list['lastLoginDate']['date']}}<br>{{$list['lastLoginDate']['time']}}</td>
                                                            <td><a href="{{$list['hrefDetail']}}" class="btn btn-main btn-sm">詳細</a></td>
                                                            <td><button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{$list['id']}}" data-type="ユーザー" data-name="user_id" data-toggle="modal" data-target=".modal-delete">削除</button></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt15">
                                <div class="col-12">
                                    <nav aria-label="page">{{$pagination}}</nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
