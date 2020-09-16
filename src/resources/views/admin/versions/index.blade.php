@extends('layouts.admin.private')

@section('content')
    <!-- Breadcrumb-->
    {{Breadcrumbs::render($breadcrumb['name'], $breadcrumb)}}
    <!-- Contents-->
    <div class="container-fluid">
        <div class="animated fadein">
            <div class="row justify-content-center">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-main">
                                <div class="d-flex justify-content-between align-items-center card-header">
                                    <h3><i class="fas fa-list-ol mr10"></i>バージョン管理</h3>
                                </div>
                                <div class="pt30 card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form class="form-horizontal" action="{{route('admin.version.index')}}" method="post" id="form-version" accept-charset="utf-8"><input type="hidden" name="os_type" value="ios">
                                                @csrf
                                                <input id="current_version" type="hidden" value="{{$version['version']}}">
                                                <div class="form-group validateGroup row"><label class="col-form-label col-sm-3">現バージョン</label>
                                                    <div class="col-sm-9">
                                                        <p class="form-control-static">{{$version['version']}}</p>
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="next_version">新バージョン<span class="badge badge-danger ml-2">必須</span></label>
                                                    <div class="col-sm-3">
                                                        <div class="error-tip">
                                                            <div class="error-tip-inner"></div>
                                                        </div><input class="form-control validate next_version zen2han" type="text" name="next_version" id="next_version" placeholder="" data-validate="empty version">
                                                    </div>
                                                    <div class="w-100">
                                                        <div class="offset-sm-3 col-sm-8">
                                                            <p class="form-description">新バージョンは現バージョンより大きい必要があります。</p>
                                                            <p class="form-description">バージョンは半角で[x.x.x]の様にメジャーバージョン、マイナーバージョン、リビションの3つを設定します。</p>
                                                            <p class="form-description">メジャーバージョン、マイナーバージョン、リビションの数字は2桁になっても構いません。</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around pt15 pb15 card-footer">
                                    <div class="block"><button class="w300 btn btn-main btn-lg" type="submit" data-form="#form-version">
                                            <div class="fas fa-pen mr10"></div>登録する
                                        </button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors)
        <!-- Modal -->
		@include('modals.admin.error_version')
	@endif
@endsection
