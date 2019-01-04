<?php
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('/'));
});

// Ads
Breadcrumbs::for('ads.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Ads', route('ads.index'));
});

// Ads > New Ad
Breadcrumbs::for('ads.create', function ($trail) {
    $trail->parent('ads.index');
    $trail->push('New Ad', route('ads.create'));
});

// Ads > [Ad Show]
Breadcrumbs::for('ads.show', function ($trail, $ad) {
    $trail->parent('ads.index');
    $trail->push($ad->title, route('ads.show', $ad->id));
});

// Ads > [Ad Edit] > Edit Ad
Breadcrumbs::for('ads.edit', function ($trail, $ad) {
    $trail->parent('ads.show', $ad);
    $trail->push('Edit', route('ads.edit', $ad->id));
});

// Categories
Breadcrumbs::for('categories.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Categories', route('categories.index'));
});

// categories > New Category
Breadcrumbs::for('categories.create', function ($trail) {
    $trail->parent('categories.index');
    $trail->push('New Category', route('categories.create'));
});

// categories > [Category Show]
Breadcrumbs::for('categories.show', function ($trail, $category) {
    $trail->parent('categories.index');
    $trail->push($category->name, route('categories.show', $category->id));
});

// categories > [Category Edit] > Edit Category
Breadcrumbs::for('categories.edit', function ($trail, $category) {
    $trail->parent('categories.show', $category);
    $trail->push('Edit', route('categories.edit', $category->id));
});

// Users
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('users.index'));
});

// Users > New User
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users.index');
    $trail->push('New User', route('users.create'));
});

// Users > [User Show]
Breadcrumbs::for('users.show', function ($trail, $user) {
    $trail->parent('users.index');
    $trail->push($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname, route('users.show', $user->id));
});

// Users > [User Edit] > Edit User
Breadcrumbs::for('users.edit', function ($trail, $user) {
    $trail->parent('users.show', $user);
    $trail->push('Edit', route('users.edit', $user->id));
});

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('home'));
});