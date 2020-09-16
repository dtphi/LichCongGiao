<?php
/**
 * Created by PhpStorm.
 * User: Phi
 * Date: 7/17/2019
 * Time: 2:12 PM
 */
/**
 * For generating the URL, you can use any of the standard Laravel URL-generation methods, including:
 * url('path/to/route') (URL::to())
 * secure_url('path/to/route')
 * route('routename') or route('routename', 'param') or route('routename', ['param1', 'param2']) (URL::route())
 * action('controller@action') (URL::action())
 * Or just pass a string URL ('http://www.example.com/')
 */

/*-- Admin --*/
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push(__('HOME'), route('admin.dashboard'));
});

/*--- Admin.Version ---*/
Breadcrumbs::register('admin_version_index', function ($breadcrumbs, $data = []) {
    $breadcrumbs->parent('dashboard');
    $r = route('admin.version.index');
    $breadcrumbs->push(isset($data['title']) ? $data['title'] : $r, $r);
});

/*--- Admin.User ---*/
Breadcrumbs::register('admin_user_index', function ($breadcrumbs, $data = []) {
    $breadcrumbs->parent('dashboard');
    $r = route('admin.user.index');
    $breadcrumbs->push(isset($data['title']) ? $data['title'] : $r, $r);
});
Breadcrumbs::register('admin_user_registry', function ($breadcrumbs, $data = []) {
    $breadcrumbs->parent('admin_user_index', ['title' => $data['parentTitle']]);
    $r = route('admin.user.registry');
    $breadcrumbs->push(isset($data['title']) ? $data['title'] : $r, $r);
});
Breadcrumbs::register('admin_user_detail', function ($breadcrumbs, $data = []) {
    $breadcrumbs->parent('admin_user_index', ['title' => $data['parentTitle']]);
    $r = route('admin.user.detail', ['id' => $data['id']]);
    $breadcrumbs->push(isset($data['title']) ? $data['title'] : $r, $r);
});

/*--- Admin.Info ---*/
Breadcrumbs::register('admin_info_index', function ($breadcrumbs, $data = []) {
    $breadcrumbs->parent('dashboard');
    $r = route('admin.info.index');
    $breadcrumbs->push(isset($data['title']) ? $data['title'] : $r, $r);
});
Breadcrumbs::register('admin_info_registry', function ($breadcrumbs, $data = []) {
    $breadcrumbs->parent('admin_info_index', ['title' => $data['parentTitle']]);
    $r = route('admin.info.registry');
    $breadcrumbs->push(isset($data['title']) ? $data['title'] : $r, $r);
});
Breadcrumbs::register('admin_info_detail', function ($breadcrumbs, $data = []) {
    $breadcrumbs->parent('admin_info_index', ['title' => $data['parentTitle']]);
    $r = route('admin.info.detail', ['id' => $data['id']]);
    $breadcrumbs->push(isset($data['title']) ? $data['title'] : $r, $r);
});
