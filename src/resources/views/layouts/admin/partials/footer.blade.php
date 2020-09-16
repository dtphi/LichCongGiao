<footer class="app-footer"><span>Copyright © 2020
    <script type="text/javascript">
        var year = new Date().getFullYear();
        if(year != 2020) document.write('-' + year);
    </script> British American Tobacco Japan All Rights Reserved.</span></footer>

@if(isset($modal['delete']['isShow']) && $modal['delete']['isShow'])
    @component('admin.components.modal_delete', ['action' => $modal['delete']['href']])@endcomponent
@endif

@if(isset($modal['video']['isShow']) && $modal['video']['isShow'])
    @component('admin.components.modal_video', ['mainClass' => $modal['video']['modalClass']])@endcomponent
@endif

@component('admin.components.link_anchor_top') @endcomponent
