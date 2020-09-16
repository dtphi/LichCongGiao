@extends('layouts.admin.private')

@section('content')
    @php
        $user = \Auth::user();
    @endphp
    <div class="container-fluid">
        <div class="animated fadein">
            <div class="row justify-content-center mt-4">
                <div class="col-sm-12">
    @if(($user) && \View::exists('layouts.admin.partials.menus.org_' . $user->organization_id . '_type_' . $user->type))
        @include('layouts.admin.partials.menus.org_' . $user->organization_id . '_type_' . $user->type)
    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
