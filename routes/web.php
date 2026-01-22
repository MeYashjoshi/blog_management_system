<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Frontend.index');
});

Route::get('/login', function () {
    return view('Auth.login');
});

Route::get('/sigup', function () {
    return view('Auth.sigup');
});

Route::get('/forgot', function () {
    return view('Auth.forgot');
});

Route::get('/reset', function () {
    return view('Auth.reset');
});

Route::get('/verify', function () {
    return view('Auth.verify');
})->name('verify');

Route::get('/myblogs', function () {
    return view('dashboard.myblogs');
});


Route::get('/blogs', function () {
    return view('blogs.index');
})->name('blogs.index');

Route::get('/blogs/{id}', function ($id) {
    return view('blogs.index', ['id' => $id]);
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/createblog', function () {
    return view('dashboard.createblog');
})->name('blogs.create');


//Dashboard Routes

Route::get('/dashboard', function () {
    return view('Dashboard.index');
})->name('dashboard');

Route::get('/blogrequests', function () {
    return view('Dashboard.blogrequests');
});

Route::get('/requestedblog', function () {
    return view('Dashboard.requestedblog');
});

Route::get('/profile', function () {
    return view('Dashboard.profile');
});

Route::get('/settings', function () {
    return view('Dashboard.settings');
});

Route::get('/rolesandpermissions', function () {
    return view('Dashboard.rolesandpermissions');
});



// Frontend Routes

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

Route::get('/contactus', function () {
    return view('frontend.contactus');
})->name('contactus');

Route::get('/allblogs', function () {
    return view('frontend.allblogs');
})->name('allblogs');

Route::get('/authorblogs', function () {
    return view('frontend.authorblogs');
});

Route::get('/blog/{id}', function () {
    return view('frontend.blogsingle');
})->name('blog.single');



















Route::fallback(function () {
    return view('errors.404');
});
