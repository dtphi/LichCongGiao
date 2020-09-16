@extends('layouts.admin.private')

@section('content')
    <!-- Breadcrumb-->
    {{Breadcrumbs::render($breadcrumb['name'], $breadcrumb)}}
    <!-- Contents-->
    <div class="container-fluid">
        <div class="animated fadein">
            @component('admin.components.link_back_url', ['link' => $backUrl, 'text' => 'お知らせ一覧に戻る']) @endcomponent
            <div class="row justify-content-center">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-main">
                                <div class="d-flex justify-content-between align-items-center card-header">
                                    <h3><i class="fas fa-info-circle mr10"></i>お知らせ登録</h3>
                                </div>
                                <div class="pt30 card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form class="form-horizontal" action="{{route('admin.info.registry')}}" method="post" id="form-info" accept-charset="utf-8">
                                                @csrf
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="type">お知らせ対象<span class="badge badge-success ml-2">任意</span></label>
                                                    <div class="col-sm-3">
                                                        <div class="error-tip">
                                                            <div class="error-tip-inner"></div>
                                                        </div><select class="form-control get-base type" id="type" name="type">
                                                            @foreach($baseTypes as $key => $baseType)
                                                                <option value="{{($key)?$key:''}}" @if($key == $formData['type']) selected="selected" @endif>{{$baseType}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label"><span class="badge badge-success ml-2">任意</span></label>
                                                    <div class="col-sm-3">
                                                        <div class="base-select-wrap">
                                                            @if($formData['type'])
                                                                <select class="form-control validate select2 base_id" id="base_id" name="base_id" data-validate="empty">
                                                                    <option value="0">全事務局向け</option>
                                                                    @foreach($bases as $base)
                                                                        <option value="{{$base['id']}}" @if($base['id'] == $formData['base_id']) selected="selected" @endif>{{$base['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                             @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="info_title">お知らせタイトル<span class="badge badge-danger ml-2">必須</span></label>
                                                    <div class="col-sm-8">
                                                        <div class="error-tip">
                                                            <div class="error-tip-inner"></div>
                                                        </div><input class="form-control validate info_title" type="text" name="info_title" id="info_title" placeholder="" data-validate="empty max-30" maxlength="30" value="{{$formData['info_title']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="info_contents">内容<span class="badge badge-danger ml-2">必須</span></label>
                                                    <div class="col-sm-8">
                                                        <div class="error-tip">
                                                            <div class="error-tip-inner"></div>
                                                        </div><textarea class="form-control validate info_contents text-length-counter" id="info_contents" name="info_contents" rows="6" data-validate="empty" maxlength="500">{{$formData['info_contents']}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="disp_start_date">公開開始日<span class="badge badge-danger ml-2">必須</span></label>
                                                    <div class="col-sm-4">
                                                        <div class="error-tip">
                                                            <div class="error-tip-inner"></div>
                                                        </div>
                                                        <div class="input-group"><input class="form-control validate disp_start_date" type="text" name="disp_start_date" id="disp_start_date" placeholder="" readonly="readonly" data-validate="empty" data-datepicker="true" data-required="true" data-startdate="true" data-clear="false" data-time="true" data-mindate="" data-maxdate="" value="{{$formData['disp_start_date']}}">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group validateGroup row"><label class="col-sm-3 col-form-label" for="disp_end_date">公開終了日<span class="badge badge-success ml-2">任意</span></label>
                                                    <div class="col-sm-4">
                                                        <div class="error-tip">
                                                            <div class="error-tip-inner"></div>
                                                        </div>
                                                        <div class="input-group"><input class="form-control disp_end_date" type="text" name="disp_end_date" id="disp_end_date" placeholder="" readonly="readonly" data-datepicker="true" data-required="false" data-startdate="true" data-clear="true" data-time="true" data-mindate="" data-maxdate="" value="{{$formData['disp_end_date']}}">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @component('admin.components.input_back_url', ['value' => $strQuery])@endcomponent
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @component('admin.components.btn_create_form', ['id' => 'form-info'])@endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @component('admin.components.link_back_url', ['link' => $backUrl, 'text' => 'お知らせ一覧に戻る']) @endcomponent
        </div>
    </div>

    @if ($errors)
        <!-- Modal -->
		@include('modals.admin.error_info')
	@endif
@endsection
