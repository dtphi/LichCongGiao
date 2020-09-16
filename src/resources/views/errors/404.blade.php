@extends('layouts.admin.private')

@section('content')
    <div class="container-fluid">
        <div class="animated fadein">
            <div class="row justify-content-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-error"><i class="fas fa-exclamation-triangle"></i>
                                <h2 class="heading heading-error-title">404 Page not found</h2>
                                <h3 class="heading heading-error-sub-title">お探しのページは<br class="hide-sm">見つかりませんでした。</h3>
                                <p class="text">URLが間違っているか、ページが存在しません。</p>
                                <p class="text">リンク一覧から他のページをご覧ください。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
