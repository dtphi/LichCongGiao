<!-- ▼ JS Libraries ▼-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@if(isset($modal['js']['select2']) && $modal['js']['select2'])
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
@endif
@if(isset($modal['js']['yubinbango']) && $modal['js']['yubinbango'])
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
@endif
@if(isset($modal['js']['summernote']) && $modal['js']['summernote'])
    <script type="text/javascript" src="{{ asset('js/admin/common/libs/summernote-bs4.js') }}"></script><script type="text/javascript">
                $(document).ready(function()
                {
                    $('.summernote').summernote(
                    {
                        height: 300,
                        tabsize: 2
                    });
                });
            </script><!-- ▲ JS Libraries ▲-->
@endif
<!-- ▼ JS Scripts ▼-->
<script src="{{ asset('js/admin/const.js') }}"></script>
<script src="{{ asset('js/admin/admin.min.js') }}"></script><!-- ▲ JS Scripts ▲-->
