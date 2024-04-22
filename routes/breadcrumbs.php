<?php
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for("admin.app_status.index", function ($trail) {
    $trail->parent('home');
    $trail->push('App Status', route('admin.app_status.index'));
});
Breadcrumbs::for("admin.store.index", function ($trail) {
    $trail->parent('home');
    $trail->push('Store List', route('admin.store.index'));
});
