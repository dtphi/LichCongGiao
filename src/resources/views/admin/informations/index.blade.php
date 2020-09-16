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
                            <h3><i class="fas fa-info-circle mr10"></i>お知らせ一覧</h3>
                            <div class="block"><a class="btn btn-default" href="{{$registUrl}}">お知らせ登録</a></div>
                        </div>
                        <div class="pt-0 card-body">
                            <div class="row mt30">
                                <div class="col-12 tar"><a class="anchor anchor-clear-search" href="javascript:void(0);"><i class="fas fa-eraser mr10"></i>検索条件をクリア</a></div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-10 d-flex align-items-center mt10">
                                    <p class="w120 mr10 fwb text">ステータス</p>
                                    <div class="custom-control custom-radio mb0 mr10"><input class="custom-control-input input-radio" id="all" name="status" data-search-item="status" data-search-type="radio" value="all" @if($status == '') checked @endif type="radio"><label class="custom-control-label" for="all">全て</label></div>
                                    <div class="custom-control custom-radio mb0 mr10"><input class="custom-control-input input-radio" id="published" name="status" data-search-item="status" data-search-type="radio" value="1" type="radio" @if($status === 1) checked @endif><label class="custom-control-label" for="published">公開中</label></div>
                                    <div class="custom-control custom-radio mb0 mr10"><input class="custom-control-input input-radio" id="closed" name="status" data-search-item="status" data-search-type="radio" value="0" type="radio" @if($status === 0) checked @endif><label class="custom-control-label" for="closed">非公開</label></div>
                                </div>
                                <div class="col-12 col-md-2 d-flex align-items-center mt10"><button class="w100p btn btn-main btn-table-search" type="button"><i class="fas fa-filter mr10"></i>絞り込む</button></div>
                            </div>
                            <div class="mt15 pt15 block block-table-control">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <p class="fs16 text">{{$textPerPage}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt10">
                                <div class="col-12">
                                    <div class="table-wrap item">
                                        <div class="scroll-bar item">
                                            <div class="scroll-bar-inner item"></div>
                                        </div>
                                        <div class="scroll-box">
                                            <table class="table table-main table-small" id="info">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>対象</th>
                                                        <th>事務局</th>
                                                        <th>タイトル</th>
                                                        <th>公開開始日</th>
                                                        <th>公開終了日</th>
                                                        <th>状態</th>
                                                        <th>詳細・編集</th>
                                                        <th>削除</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($lists as $list)
                                                        <tr>
                                                            <td>{{$list['id']}}</td>
                                                            <td>{{$list['typeText']}}</td>
                                                            <td>{{$list['baseName']}}</td>
                                                            <td class="tal">{{$list['title']}}</td>
                                                            <td>{{$list['startDate']['date']}}<br>{{$list['startDate']['time']}}</td>
                                                            <td>{{$list['endDate']['date']}}<br>{{$list['endDate']['time']}}</td>
                                                            <td>{{$list['statusText']}}</td>
                                                            <td><a href="{{$list['hrefDetail']}}" class="btn btn-main btn-sm">詳細</a></td>
                                                            <td><button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{$list['id']}}" data-type="お知らせ" data-name="info_id" data-toggle="modal" data-target=".modal-delete">削除</button></td>
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
