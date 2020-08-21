<?php

use Illuminate\Support\Facades\Route;

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


//Auth::routes();



Route::namespace('Auth')->group(function () {
    
    Route::get('/','LoginController@showLoginForm')->name('login');
    Route::get('/login','LoginController@showLoginForm')->name('login');
    Route::post('/login','LoginController@login')->name('login');
    Route::get('/register','LoginController@showRegistrationForm')->name('register');
    Route::post('/register','LoginController@process_signup');
    Route::post('/logout','LoginController@logout')->name('logout');
    
});

Route::group(['middleware' => ['auth']], function () {
    
    //admin route
    Route::middleware(['admin'])->namespace('Admin')->group(function(){
        
        Route::get('/admin', 'DashboardController@index')->name('admin');
        
        // Super Admin - User
        Route::group(['prefix' => 'users'], function () {
            Route::get('/view',                'UserController@view')->name('users.view');
            Route::get('/all/users',           'UserController@getUser')->name('user.getUser');
        	Route::get('/add',                 'UserController@add')->name('users.add');
        	Route::post('/store',              'UserController@store')->name('users.store');
        	Route::get('/edit/{id}',           'UserController@edit')->name('users.edit');
        	Route::post('/update/{id}',        'UserController@update')->name('users.update');
        	Route::get('/delete/{id}',         'UserController@delete')->name('users.delete');
        	
        	Route::get('/approve-list',        'UserController@UserApproveList')->name('users.UserApproveList');
        	Route::get('/approve/all',         'UserController@getUserApproveList')->name('users.getUserApproveList');
        	
        	Route::get('/pending-list',        'UserController@UserPendingList')->name('users.UserPendingList'); 
        	Route::get('/pending/all',         'UserController@getUserPendingList')->name('users.getUserPendingList');
        	
        	Route::get('/suspend-list',        'UserController@UserSuspendList')->name('users.UserSuspendList');
        	Route::get('/suspend/all',         'UserController@getUserSuspendList')->name('users.getUserSuspendList');
        	Route::post('/approve/{id}',       'UserController@userApprove')->name('user.Approve');
        });
        // Super Admin - Package
        Route::group(['prefix' => 'package'], function () {
            
            Route::get('/list',                'PackageController@list')->name('package.list');
            Route::get('/all/packages',        'PackageController@getPackage')->name('package.getPackage');
        	Route::get('/add',                 'PackageController@add')->name('package.add');
        	Route::post('/store',              'PackageController@store')->name('package.store');
        	Route::get('/edit/{id}',           'PackageController@edit')->name('package.edit');
        	Route::post('/update',             'PackageController@update')->name('package.update');
        	Route::get('/delete/{id}',         'PackageController@delete')->name('package.delete');
        	Route::get('/all-package',         'PackageController@AllPackage')->name('all.package');
        	
        
        	
        });
        
        // Super Admin - PackageTwo
        Route::group(['prefix' => 'package-two'], function () {
            
            Route::get('/list',                 'PackageTwoController@list')->name('package.two.list');
        	Route::get('/add',                  'PackageTwoController@add')->name('package.two.add');
        	Route::post('/store',               'PackageTwoController@store')->name('package.two.store');
        	Route::get('/edit/{id}',            'PackageTwoController@edit')->name('package.two.edit');
        	Route::post('/update',              'PackageTwoController@update')->name('package.two.update');
        	Route::get('/delete/{id}',          'PackageTwoController@delete')->name('package.two.delete');
        	Route::get('/all-package',          'PackageTwoController@AllPackage')->name('all.package.two');
        
        	
        });
	    // Super Admin - Category
	    Route::group(['prefix' => 'category'], function () {
    	    Route::get('/list',                 'CategoryController@list')->name('category.list');
    	    Route::get('/all-category',         'CategoryController@getCategory')->name('category.getCategory');
        	Route::get('/add',                  'CategoryController@add')->name('category.add');
        	Route::post('/store',               'CategoryController@store')->name('category.store');
        	Route::get('/edit/{id}',            'CategoryController@edit')->name('category.edit');
        	Route::post('/update/{id}',         'CategoryController@update')->name('category.update');
        	Route::get('/delete/{id}',          'CategoryController@delete')->name('category.delete');
        	
	    });
    	// Super Admin - Case
    	Route::group(['prefix' => 'case'], function () {
            	Route::get('/list',             'CaseController@list')->name('case.list');
            	Route::get('/add',              'CaseController@add')->name('case.add');
            	Route::post('/store',           'CaseController@store')->name('case.store');
            	Route::get('/edit/{id}',        'CaseController@edit')->name('case.edit');
            	Route::post('/update/{id}',     'CaseController@update')->name('case.update');
            	Route::get('/delete/{id}',      'CaseController@delete')->name('case.delete');
            	
            	
            	Route::get('/all/client/casse', 'ProjectController@getCase')->name('client.getCase');
            	Route::get('/approve-list',     'ProjectController@caseApproveList')->name('casse.caseApproveList');
            	Route::get('/approve/all',      'ProjectController@getCaseApproveList')->name('casse.getCaseApproveList');
            	Route::get('/pending-list',     'ProjectController@casePendingList')->name('casse.casePendingList');
            	Route::get('/pending/all',      'ProjectController@getCasePendingList')->name('casse.getCasePendingList');
            	Route::get('/suspend-list',     'ProjectController@caseSuspendList')->name('casse.CaseSuspendList');
            	Route::get('/suspend/all',      'ProjectController@getCaseSuspendList')->name('casse.getCaseSuspendList');
            	Route::get('/active/{id}',      'ProjectController@getActiveCase')->name('casse.active');
            	Route::get('/inactive',      'ProjectController@getInActiveCase')->name('casse.inactive');
        	});
        	
        	
    });
    
    
    //common route for client & lawyer
    Route::namespace('Pages')->group(function () {
        //Route::get('/{uid}/profile', 'DashboardController@getProfile');
        
        Route::post('/send-verification-code', 'PhoneVerificationController@sendVerificationCode')->name('send.varification.code');
        Route::post('/resend-verification-code', 'PhoneVerificationController@resendVerificationCode')->name('resend.varification.code');
        Route::post('/verify', 'PhoneVerificationController@verify')->name('varify.code');
        
        
    });
    
    
    
    //client route
    Route::middleware('client')->namespace('Client')->group(function () {
        
        Route::get('/{uid}/client/profile', 'ClientProfileController@getProfile')->name('client.profile');
        Route::get('/{uid}/client/edit-profile', 'ClientProfileController@editProfile')->name('client.edit.profile');
        Route::post('/client/edit-profile', 'ClientProfileController@updateProfile')->name('client.update.profile');
        Route::post('/client/profile-image-upload', 'ClientProfileController@profileImageUpload')->name('client.profile.image.upload');
        Route::post('/client/profile-image-delete', 'ClientProfileController@profileImageDelete')->name('client.profile.image.delete');
        Route::post('/client-password-change', 'ClientProfileController@userChangePassword')->name('client.password.change');
        
        Route::post('/client/send-verification-code', 'PhoneVerificationController@sendVerificationCode')->name('client.send.varification.code');
        
        Route::get('/{uid}/client/create-case', 'ProjectController@create')->name('client.case.create'); 
        Route::post('/client/store-case', 'ProjectController@store')->name('client.case.store');
        Route::get('/client/case/{slug}', 'ProjectController@show')->name('client.case.show');
        Route::get('/client/case-slug/{slug}', 'ProjectController@getCaseOnPopup')->name('client.case.show.popup');
        Route::get('/client/edit-case/{slug}', 'ProjectController@editCase')->name('client.case.edit');
        Route::post('/client/update-case/{slug}', 'ProjectController@updateCase')->name('client.case.update');
        
        
        
        
        Route::get('/{uid}/client/cases', 'DashboardController@getCases')->name('client.get.case');
        Route::get('/{uid}/client/new-cases', 'DashboardController@getSubCases')->name('client.new.case');
        Route::get('/{uid}/client/approved-cases', 'DashboardController@getApprovedCases')->name('client.approved.case');
        Route::get('/{uid}/client/pending-cases', 'DashboardController@getPendingCasess')->name('client.pending.case');
        Route::get('/{uid}/client/cases-bided-on', 'DashboardController@getBidedCases')->name('client.bided.case');
        Route::get('/{uid}/client/active-cases', 'DashboardController@getActiveCases')->name('client.active.case');
        Route::get('/{uid}/client/complete-cases', 'DashboardController@getCompleteCases')->name('client.complete.case');
        Route::get('/{uid}/client/notifications', 'DashboardController@getNotifications')->name('client.notifications');
        Route::get('/{uid}/client/payments', 'DashboardController@getPayments')->name('client.payment');
        
        Route::get('user/notification-count', 'DashboardController@getNotificationCount')->name('client.notification.count');
        Route::get('/searched-cases', 'DashboardController@getSearchedCases')->name('client.search.case');
        Route::get('/search-lawyers-dashboard', 'DashboardController@getSearchedLawyers')->name('client.searched.lawyers');
        Route::get('/{uid}/client/conversations', 'InterviewController@conversations')->name('client.conversations');
        
        // =================================== Find Lawyer ====================================
        Route::get('/{uid}/client/find-cases', 'SearchController@getFindCasesPage')->name('client.find.cases');
        Route::get('/{uid}/client/search-cases', 'SearchController@getSearchCases')->name('client.search.cases');
        // =================================== Find Lawyer ====================================
        Route::get('/{uid}/client/find-lawyer', 'SearchController@getFindLawyersPage')->name('client.find.lawyer'); 
        Route::get('/{uid}/client/search-lawyers', 'SearchController@getLawyers')->name('client.search.lawyer');

        
    });
    
    //lawyer route
    Route::middleware('lawyer')->namespace('Lawyer')->group(function () {
        
        Route::get('/{uid}/lawyer/profile', 'LawyerProfileController@getProfile')->name('lawyer.profile');
        Route::get('/{uid}/lawyer/edit-profile', 'LawyerProfileController@editProfile')->name('lawyer.edit.profile');
        Route::post('/lawyer/edit-profile', 'LawyerProfileController@updateProfile')->name('lawyer.update.profile');
        Route::post('/lawyer-password-change', 'LawyerProfileController@userChangePassword')->name('lawyer.password.change');
        
        Route::post('/lawyer/send-verification-code', 'PhoneVerificationController@sendVerificationCode')->name('lawyer.send.varification.code');
        
        Route::get('/{uid}/lawyer/create-case', 'ProjectController@create')->name('lawyer.case.create');
        Route::post('/lawyer/store-case', 'ProjectController@store')->name('lawyer.case.store'); 
        Route::get('/lawyer/case/{slug}', 'ProjectController@show')->name('lawyer.case.show');
        Route::get('/lawyer/edit-case/{slug}', 'ProjectController@editCase')->name('lawyer.case.edit');
        Route::post('/lawyer/update-case/{slug}', 'ProjectController@updateCase')->name('lawyer.case.update');
        
        Route::get('/{uid}/lawyer/cases', 'DashboardController@getCases')->name('lawyer.get.case');
        Route::get('/{uid}/lawyer/new-cases', 'DashboardController@getSubCases')->name('lawyer.new.case');
        Route::get('/{uid}/lawyer/approved-cases', 'DashboardController@getApprovedCases')->name('lawyer.approved.case');
        Route::get('/{uid}/lawyer/pending-cases', 'DashboardController@getPendingCasess')->name('lawyer.pending.case');
        Route::get('/{uid}/lawyer/cases-bided-on', 'DashboardController@getBidedCases')->name('lawyer.bided.case');
        Route::get('/{uid}/lawyer/active-cases', 'DashboardController@getActiveCases')->name('lawyer.active.case');
        Route::get('/{uid}/lawyer/complete-cases', 'DashboardController@getCompleteCases')->name('lawyer.complete.case');
        Route::get('/{uid}/lawyer/notifications', 'DashboardController@getNotifications')->name('lawyer.notifications');
        Route::get('/{uid}/lawyer/payments', 'DashboardController@getPayments')->name('lawyer.payment');
        
        Route::get('user/notification-count', 'DashboardController@getNotificationCount')->name('lawyer.notification.count');
        Route::get('/searched-cases', 'DashboardController@getSearchedCases')->name('lawyer.search.case');
        Route::get('/search-lawyers-dashboard', 'DashboardController@getSearchedLawyers')->name('lawyer.searched.lawyers');
        Route::get('/{uid}/lawyer/conversations', 'InterviewController@conversations')->name('lawyer.conversations');
        
        
        Route::get('/{uid}/lawyer/create-proposal/slug', 'ProposalController@create')->name('lawyer.create.proposal');
        Route::post('/{uid}/lawyer/create-proposal/{project_slug}', 'ProposalController@store');
        
        // =================================== Find Lawyer ====================================
        Route::get('/{uid}/lawyer/find-cases', 'SearchController@getFindCasesPage')->name('lawyer.find.cases');
        Route::get('/{uid}/lawyer/search-cases', 'SearchController@getSearchCases')->name('lawyer.search.cases');
        // =================================== Find Lawyer ====================================
        Route::get('/{uid}/lawyer/find-lawyer', 'SearchController@getFindLawyersPage')->name('lawyer.find.lawyer'); 
        Route::get('/{uid}/lawyer/search-lawyers', 'SearchController@getLawyers')->name('lawyer.search.lawyer');

        
        
    });
    
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

// old applicatin all route...

/*Route::middleware(['auth'])->group(function(){


    Route::middleware(['email_confirmed'])->group(function(){
        
        Route::get('/edit-profile', 'Pages\ProfileController@editProfile');
        Route::post('/change-password', 'Pages\ProfileController@changePassword')->name('change.password');

        Route::middleware(['complete_profile'])->group(function(){
            
            Route::namespace('Pages')->group(function(){
                
                Route::get('/dashboard/cases', 'DashboardController@getCases');
                
            });
        });

         
        Route::middleware(['client'])->group(function(){

            Route::middleware(['complete_profile'])->group(function(){
                
                Route::namespace('Pages')->group(function(){
                    Route::get('/create-case', 'ProjectController@create');
                    Route::post('/create-case', 'ProjectController@store');
                });
            });

        });
        
    });

});*/





