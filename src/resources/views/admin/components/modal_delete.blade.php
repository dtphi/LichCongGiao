<div class="fade modal modal-delete" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <h5 class="modal-title"><span class="name"></span>削除</h5>
                </h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="text text-delete">本当にこの<span class="name"></span>を削除してよろしいでしょうか？</p>
                <form class="form-horizontal" action="{{$action}}" method="post" id="form-delete" accept-charset="utf-8">
                    @csrf
                    <input class="input-delete" type="hidden"></form>
            </div>
            <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">キャンセル</button><button class="btn btn-danger" type="submit" data-form="#form-delete">削除する</button></div>
        </div>
    </div>
</div>
