<?php

// FRONT-END ROUTES

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Round;

Route::get('/', 'FrontpageController@index')->name('home');
Route::get('/slider', 'FrontpageController@slider')->name('slider.index');

Route::get('/search', 'PagesController@search')->name('search');

Route::get('/agents', 'PagesController@agents')->name('agents');
Route::get('/agents/{id}', 'PagesController@agentshow')->name('agents.show');

Route::get('/about-me', 'PagesController@aboutMe')->name('about.me');

Route::get('/gallery', 'PagesController@gallery')->name('gallery');

Route::get('/blog', 'PagesController@blog')->name('blog');
Route::get('/blog/{id}', 'PagesController@blogshow')->name('blog.show');
Route::post('/blog/comment/{id}', 'PagesController@blogComments')->name('blog.comment');

Route::get('/blog/categories/{slug}', 'PagesController@blogCategories')->name('blog.categories');
Route::get('/blog/tags/{slug}', 'PagesController@blogTags')->name('blog.tags');
Route::get('/blog/author/{username}', 'PagesController@blogAuthor')->name('blog.author');

Route::get('/contact', 'PagesController@contact')->name('contact');
Route::post('/contact', 'PagesController@messageContact')->name('contact.message');

Auth::routes();

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin'], 'as' => 'admin.'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('tags', 'TagController');
    Route::resource('categories', 'CategoryController');
    Route::resource('posts', 'PostController');

    Route::resource('sliders', 'SliderController');
    Route::resource('services', 'ServiceController');
    Route::resource('testimonials', 'TestimonialController');

    Route::get('galleries/album', 'GalleryController@album')->name('album');
    Route::post('galleries/album/store', 'GalleryController@albumStore')->name('album.store');
    Route::get('galleries/{id}/gallery', 'GalleryController@albumGallery')->name('album.gallery');
    Route::post('galleries', 'GalleryController@Gallerystore')->name('galleries.store');

    Route::get('settings', 'DashboardController@settings')->name('settings');
    Route::post('settings', 'DashboardController@settingStore')->name('settings.store');

    Route::get('profile', 'DashboardController@profile')->name('profile');
    Route::post('profile', 'DashboardController@profileUpdate')->name('profile.update');
    Route::get('/about-me', 'AboutController@about')->name('about');
    Route::post('/about-me/{id?}', 'AboutController@aboutSave')->name('about.save');

    Route::get('changepassword', 'DashboardController@changePassword')->name('changepassword');
    Route::post('changepassword', 'DashboardController@changePasswordUpdate')->name('changepassword.update');

});
