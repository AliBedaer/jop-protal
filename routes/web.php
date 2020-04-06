<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(
	[
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],

    function(){

    	// Welcome Route (Home Page)

    		Route::get('/','WelcomeController@index');

        // Profile Route

            Route::get('profile','ProfileController@ShowEditProfile')->name('profile');
            Route::post('profile','ProfileController@updateProfile')->name('profile.update');
            Route::put('profile/password/change','ProfileController@changePassword')->name('profile.change');

        // Users Routes

            Route::get('seekers','SeekerController@index')->name('seekers.index');
            Route::get('companies','CompanyController@index')->name('companies.index');
            Route::get('seekers/{id}/{slug}','SeekerController@show')->name('seekers.show');
            Route::get('companies/{id}/{slug}','CompanyController@show')->name('companies.show');
            Route::get('company/jobs','CompanyController@jobs')->name('company.jobs');
            Route::get('company/notifications','CompanyController@notifications')->name('company.notifications');
            Route::post('jobs/{slug}/apply', 'SeekerController@applyJob')->name('jobs.apply');
            Route::post('jobs/{slug}/save', 'SeekerController@saveJob')->name('jobs.save');
            Route::get('jobs/saved', 'SeekerController@savedJobs')->name('jobs.saved');
            Route::delete('jobs/saved/{slug}/destroy', 'SeekerController@destroySaved')->name('jobs.destroySaved');
            Route::get('jobs/applied', 'SeekerController@appliedJobs')->name('jobs.applied');
            Route::delete('jobs/applied/{slug}/destroy', 'SeekerController@destroyApplied')->name('jobs.destroyApplied');


        // Cancel Seeker

            Route::delete('cancel/{job}/{seeker}/{company}/send','CompanyController@cancelApplicant')->name('companies.cancel');
           
        // Tags Routes

            Route::get('jobs/tags/{slug}','TagController@jobsShow')->name('tags.jobs.show');
            Route::get('posts/tags/{slug}','TagController@postsShow')->name('tags.posts.show');

        // Skills Routes

            Route::get('skills/{slug}','SkillController@show')->name('skills.show');

        // Categories Routes

            Route::get('categories/{slug}','CategoryController@show')->name('categories.show');


        // Jobs Routes

            Route::resource('jobs','JobController')->except(['show']);
            Route::get('jobs/{slug}','JobController@show')->name('jobs.show');
           

        // Posts Routes 

            Route::resource('posts','PostController')->except(['show']);
            Route::get('posts/{slug}','PostController@show')->name('posts.show');

        // Contact Routes 

            Route::get('contact','ContactController@showContactPage')->name('contact.get');
            Route::post('contact','ContactController@contact')->name('contact.post');

    	// Auth Route 

    	    Auth::routes();


    
    }

);





