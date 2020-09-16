@if(!empty($id))
    <div class="d-flex justify-content-around pt15 pb15 card-footer">
        <div class="block">
            <button class="w300 btn btn-main btn-lg" type="submit" data-form="#{{$id}}">
                <div class="fas fa-save mr10"></div>更新する
            </button>
        </div>
    </div>
@endif
