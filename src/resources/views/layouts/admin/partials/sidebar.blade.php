@php
    $user = \Auth::user();
@endphp
@if(($user) && \View::exists('layouts.admin.partials.sidebars.org_' . $user->organization_id . '_type_' . $user->type))
    @include('layouts.admin.partials.sidebars.org_' . $user->organization_id . '_type_' . $user->type)
@else
    <div class="sidebar">
        <nav class="sidebar-nav">
        </nav><button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>
@endif
