@extends('layouts.admin.private')

@section('content')
    <!-- Breadcrumb-->
    {{Breadcrumbs::render($breadcrumb['name'], $breadcrumb)}}
    <!-- Contents-->
    <div class="container-fluid">
        <div class="animated fadein">
            <div class="d-flex justify-content-between mt15 block"><a class="anchor anchor-chevron-left" href="{{$hrefDetail}}">ユーザー詳細に戻る</a></div>
            <div class="row justify-content-center">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-main">
                                <div class="d-flex justify-content-between align-items-center card-header">
                                    <h3><i class="fas fa-users mr10"></i>ユーザー行動履歴</h3>
                                </div>
                                <div class="pt30 card-body">
                                    <div class="mt15 pt15 block block-table-control">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-between align-items-center">
                                                <p class="fs16 text">{{$textPerPage}}</p>
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
                                                    <table class="table table-main table-small" id="activity">
                                                        <thead>
                                                            <tr>
                                                                <th>日時</th>
                                                                <th>内容</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($lists as $list)
                                                                <tr>
                                                                    <td>{{$list['createdAt']}}</td>
                                                                    <td class="tal">{{$list['action']}}</td>
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
            <div class="d-flex justify-content-between mt15 mb30 block"><a class="anchor anchor-chevron-left" href="{{$hrefDetail}}">ユーザー詳細に戻る</a></div>
        </div>
    </div>
@endsection
