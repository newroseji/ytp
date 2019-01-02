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
    $trail->push('Edit Ad', route('ads.edit', $ad->id));
});