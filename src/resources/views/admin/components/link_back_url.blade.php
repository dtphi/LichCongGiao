@if(!empty($link))
    @php
        $title = isset($text) ? $text : '一覧に戻';
        $class = isset($class) ? $class : '';
    @endphp
    <div class="d-flex justify-content-between mt15 block {{$class}}">
        <a class="anchor anchor-chevron-left" href="{{$link}}">{{$title}}</a>
    </div>
@endif
