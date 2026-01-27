<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SystemSettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


//Public Routes

Route::get('/', function () {
    return view('Frontend.index');
})->name('Home');

Route::get('/about', function () {
    return view('Frontend.about');
})->name('about');

Route::get('/contactus', function () {
    return view('Frontend.contactus');
})->name('contactus');

Route::get('/rolesandpermissions', function () {
    return view('Dashboard.rolesandpermissions');
})->name('rolesandpermissions');



// Route::get('/dashboard', function () {
//     return view('Dashboard.index');
// })->name('dashboard');


Route::controller(HomeController::class)->group(function () {

    //Page Routes (Display forms)
    Route::get('/', 'showHome')->name('home.page');
    Route::get('/about', 'showAbout')->name('about.page');
    Route::get('/contactus', 'showContactus')->name('contactus.page');
    Route::get('/dashboard', 'showDashboard')->name('dashboard.page');

});



Route::controller(AuthController::class)->group(function () {

    //Page Routes (Display forms)
    Route::get('/login', 'showLoginForm')->name('login.page');
    Route::get('/signup', 'showSignupForm')->name('signup.page');
    Route::get('/forgot-password', 'showForgotPasswordForm')->name('forgot-password.page');
    Route::get('/reset-password', 'showResetPasswordForm')->name('reset-password.page');

    //Script Routes (Process form submissions)
    Route::post('/login', 'login')->name('login');
    Route::post('/signup', 'signup')->name('signup');
    Route::post('/sendpasswordresetlink', 'sendPasswordResetLink')->name('sendpasswordresetlink');
    Route::post('/resetpassword', 'resetPassword')->name('resetpassword');
    Route::get('getUserStatus', 'getUserStatus')->name('getUserStatus');
    Route::get('getUserRole', 'getUserRole')->name('getUserRole');
    Route::post('/logout', 'logout')->name('logout');



});


Route::controller(BlogController::class)->group(function () {

    //Page Routes (Display forms)
    Route::get('/blogs', 'showBlogs')->name('blogs.page');
    Route::get('/blog/{id}', 'showBlog')->name('showblog.page');
    Route::get('/manageblog', 'showManageBlog')->name('manageblog.page');
    Route::get('/blogrequests', 'showBlogRequests')->name('blogrequests.page');
    Route::get('/requestedblog', 'showBlogRequestedBlog')->name('requestedblog.page');
    Route::get('/myblogs', 'showMyBlogs')->name('myblogs.page');


    //Script Routes (Process form submissions)
    Route::get('getBlogDetails', 'getBlogDetails')->name('getBlogDetails');
    Route::get('getBlogs', 'getBlogs')->name('getBlogs');
    Route::post('manageBlog', 'manageBlog')->name('manageBlog');
    Route::post('statusBlog', 'statusBlog')->name('statusBlog');
    Route::get('blogStatistics', 'blogStatistics')->name('blogStatistics');
    Route::get('RecentBlogs', 'RecentBlogs')->name('RecentBlogs');
    Route::get('trendingBlogs', 'trendingBlogs')->name('trendingBlogs');
    Route::post('deleteBlog', 'deleteBlog')->name('deleteBlog');

});


Route::controller(CategoryController::class)->group(function () {

    //Page Routes (Display forms)
    Route::get('/categories', 'showCategories')->name('categories.page');
    Route::get('/managecategory', 'showManageCategory')->name('managecategories.page');


    //Script Routes (Process form submissions)
    Route::get('getCategoryDetails', 'getCategoryDetails')->name('getCategoryDetails');
    Route::get('getCategories', 'getCategories')->name('getCategories');
    Route::post('manageCategory', 'manageCategory')->name('manageCategory');
    Route::post('statusCategory', 'statusCategory')->name('statusCategory');
    Route::get('categoryStatistics', 'categoryStatistics')->name('categoryStatistics');
    Route::post('deleteCategory', 'deleteCategory')->name('deleteCategory');

});


Route::controller(CommentController::class)->group(function () {

    Route::get('getCommentDetails', 'getCommentDetails')->name('getCommentDetails');
    Route::get('getComments', 'getComments')->name('getComments');
    Route::post('manageComment', 'manageComment')->name('manageComment');
    Route::post('statusComment', 'statusComment')->name('statusComment');
    Route::get('commentStatistics', 'commentStatistics')->name('commentStatistics'); // Display How many comments on a blog
    Route::post('deleteComment', 'deleteComment')->name('deleteComment');

});



Route::controller(UserController::class)->group(function () {

    Route::get('getUserDetails', 'getUserDetails')->name('getUserDetails');
    Route::get('getUsers', 'getUsers')->name('getUsers');
    Route::post('manageUser', 'manageUser')->name('manageUser');
    Route::post('statusUser', 'statusUser')->name('statusUser');
    Route::get('userStatistics', 'userStatistics')->name('userStatistics');
    Route::post('deleteUser', 'deleteUser')->name('deleteUser');

});

Route::controller(SystemSettingController::class)->group(function () {

    Route::get('getSystemSettingDetails', 'getSystemSettingDetails')->name('getSystemSettingDetails');
    Route::get('getSystemSettings', 'getSystemSettings')->name('getSystemSettings');
    Route::post('manageSystemSetting', 'manageSystemSetting')->name('manageSystemSetting');
    Route::post('statusSystemSetting', 'statusSystemSetting')->name('statusSystemSetting');
    Route::get('userSystemSettings', 'userSystemSettings')->name('userSystemSettings');
    Route::post('deleteSystemSetting', 'deleteSystemSetting')->name('deleteSystemSetting');

});

Route::controller(TagController::class)->group(function () {

    Route::get('getTagsDetails', 'getTagsDetails')->name('getTagsDetails');
    Route::get('getTags', 'getTags')->name('getTags');
    Route::post('manageTag', 'manageTag')->name('manageTag');
    Route::post('statusTag', 'statusTag')->name('statusTag');
    Route::get('tagStatistics', 'tagStatistics')->name('tagStatistics');
    Route::post('deleteTag', 'deleteTag')->name('deleteTag');

});

Route::fallback(function () {
    return view('errors.404');
});
