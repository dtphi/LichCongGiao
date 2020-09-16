<div class="modal modal-error fade" id="errModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body tac">
        <div class="text-danger mb20" style="font-size: 60px;">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                {{--@if(isset($errors['type_error']))
                    <p>@lang('お知らせ対象')</p>
                    @foreach ($errors['type_error'] as $message)
                        <div class="text-danger mb20">
                            {{$message}}
                        </div>
                    @endforeach
                @endif

          @if(isset($errors['base_id_error']))
                    <p>@lang('お知らせ対象')</p>
                    @foreach ($errors['base_id_error'] as $message)
                        <div class="text-danger mb20">
                            {{$message}}
                        </div>
                    @endforeach
                @endif

          @if(isset($errors['info_title_error']))
                    <p>@lang('お知らせタイトル')</p>
                    @foreach ($errors['info_title_error'] as $message)
                        <div class="text-danger mb20">
                            {{$message}}
                        </div>
                    @endforeach
                @endif

          @if(isset($errors['info_contents_error']))
                    <p>@lang('内容')</p>
                    @foreach ($errors['info_contents_error'] as $message)
                        <div class="text-danger mb20">
                            {{$message}}
                        </div>
                    @endforeach
                @endif

          @if(isset($errors['disp_start_date_error']))
                    <p>@lang('公開開始日')</p>
                    @foreach ($errors['disp_start_date_error'] as $message)
                        <div class="text-danger mb20">
                            {{$message}}
                        </div>
                    @endforeach
                @endif

          @if(isset($errors['disp_end_date_error']))
                    <p>@lang('公開終了日')</p>
                    @foreach ($errors['disp_end_date_error'] as $message)
                        <div class="text-danger mb20">
                            {{$message}}
                        </div>
                    @endforeach
                @endif--}}

          <p>入力項目に誤りがあります</p>

          @if(isset($errors['db_error']))
                    <p>@lang('Server error')</p>
                    @foreach ($errors['db_error'] as $message)
                        <div class="text-danger mb20">
                            {{$message}}
                        </div>
                    @endforeach
                @endif
      </div>
      <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            </div>
    </div>
  </div>
</div>

@include('modals.js_modal')
