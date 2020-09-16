<!-- Modal -->
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
          @if($errors->get('mail_address_error'))
                <p>@lang($lgDir.'.txt_title_mail')</p>
                @foreach ($errors->get('mail_address_error') as $message)
                    <div class="text-danger mb20">
                        {{$message}}
                    </div>
                @endforeach
            @endif
              @if($errors->get('mail_address_confirm_error'))
                <p>@lang($lgDir.'.txt_title_mail_conf')</p>
                @foreach ($errors->get('mail_address_confirm_error') as $message)
                    <div class="text-danger mb20">
                        {{$message}}
                    </div>
                @endforeach
            @endif
        @if($errors->get('db_error'))
            <p>@lang($lg.'txt_error_server')</p>
            @foreach ($errors->get('db_error') as $message)
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
