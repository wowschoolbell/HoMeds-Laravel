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

Breadcrumbs::for('admin.store.create', function ($trail) {
    $trail->push('Add Store', route('admin.store.create'));
});
Breadcrumbs::for('admin.store.edit', function ($trail) {
     $view =isset($_GET['view'])?true:false; 
    if($view){
        $trail->push('View Store', route('admin.store.create'));
    } else {
         $trail->push('Edit Store', route('admin.store.create'));
    }
});


