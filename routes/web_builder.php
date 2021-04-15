<?php
// user site
// Route::get('getCurl', 'JoshController@getCurl')->name('getCurl');
Route::group(
    ['prefix' => 'project', 'middleware' => 'user'],
    function () {
        Route::post('post-project-lead', 'ProjectController@postProjectLead')->name('ProjectLead.new');
        Route::get('project-bid-response/{id}', 'ProjectController@projectBidResponse');
        Route::get('profile-projectbid/{id}', 'ProjectController@profileProjectbid')->name('project.profileProjectbid');

        Route::post('project-lead-convert', 'ProjectController@projectLeadConvert');
        Route::get('project-schedule/{id}', 'ProjectController@projectSchedule')->name('project-schedule');
        Route::get('project-schedule-modify/{id}', 'ProjectController@projectScheduleModify')->name('project-schedule-modify');

        Route::post('post-project-schedule', 'ProjectController@postProjectSchedule')->name('projectschedule.create');
        Route::post('update-project-schedule', 'ProjectController@updateProjectSchedule')->name('projectschedule.update-modify');
        Route::get('contract-details/{id}', 'ProjectController@contractDetails')->name('contract-details');
        Route::post('post-project-contract', 'ProjectController@postProjectContract')->name('projectcontract.create');

        Route::get('project-finance/{id}', 'ProjectController@projectFinance')->name('project-finance');
        Route::post('project-send-finance', 'ProjectController@sendProjectFinance')->name('project-finance.send');

        Route::post('assign-project', 'ProjectController@assignProject')->name('assignProject');
    }
);

/* custom routes generated by CRUD */
Route::group(
    ['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin', 'as' => 'admin.'],
    function () {
		Route::post('users/updateinformation', 'UsersController@updateuser_information')->name('user_information');
        Route::post('users/update-education', 'UsersController@updateuser_education')->name('updateuser_education');
         Route::post('users/update-certificate', 'UsersController@updateuser_certificate')->name('updateuser_certificate');
         Route::post('users/update-professionalexp', 'UsersController@updateuser_professionalexp')->name('updateuser_professionalexp');
         Route::post('users/update-project', 'UsersController@updateuser_project')->name('updateuser_project');
         Route::post('users/update-employer', 'UsersController@updateuser_employer')->name('updateuser_employer');
         Route::get('/getframework', 'UsersController@getframework');
    }
);

Route::group(array('prefix' => 'admin/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.'), function () {

Route::get('technologies', ['as'=> 'technologies.index', 'uses' => 'TechnologyController@index']);
Route::post('technologies', ['as'=> 'technologies.store', 'uses' => 'TechnologyController@store']);
Route::get('technologies/create', ['as'=> 'technologies.create', 'uses' => 'TechnologyController@create']);
Route::put('technologies/{technologies}', ['as'=> 'technologies.update', 'uses' => 'TechnologyController@update']);
Route::patch('technologies/{technologies}', ['as'=> 'technologies.update', 'uses' => 'TechnologyController@update']);
Route::get('technologies/{id}/delete', array('as' => 'technologies.delete', 'uses' => 'TechnologyController@getDelete'));
Route::get('technologies/{id}/confirm-delete', array('as' => 'technologies.confirm-delete', 'uses' => 'TechnologyController@getModalDelete'));
Route::get('technologies/{technologies}', ['as'=> 'technologies.show', 'uses' => 'TechnologyController@show']);
Route::get('technologies/{technologies}/edit', ['as'=> 'technologies.edit', 'uses' => 'TechnologyController@edit']);

});

Route::group(array('prefix' => 'admin/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.'), function () {

Route::get('designations', ['as'=> 'designations.index', 'uses' => 'DesignationController@index']);
Route::post('designations', ['as'=> 'designations.store', 'uses' => 'DesignationController@store']);
Route::get('designations/create', ['as'=> 'designations.create', 'uses' => 'DesignationController@create']);
Route::put('designations/{designations}', ['as'=> 'designations.update', 'uses' => 'DesignationController@update']);
Route::patch('designations/{designations}', ['as'=> 'designations.update', 'uses' => 'DesignationController@update']);
Route::get('designations/{id}/delete', array('as' => 'designations.delete', 'uses' => 'DesignationController@getDelete'));
Route::get('designations/{id}/confirm-delete', array('as' => 'designations.confirm-delete', 'uses' => 'DesignationController@getModalDelete'));
Route::get('designations/{designations}', ['as'=> 'designations.show', 'uses' => 'DesignationController@show']);
Route::get('designations/{designations}/edit', ['as'=> 'designations.edit', 'uses' => 'DesignationController@edit']);

});





Route::group(array('prefix' => 'admin/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.'), function () {

Route::get('educationTypes', ['as'=> 'educationTypes.index', 'uses' => 'EducationTypeController@index']);
Route::post('educationTypes', ['as'=> 'educationTypes.store', 'uses' => 'EducationTypeController@store']);
Route::get('educationTypes/create', ['as'=> 'educationTypes.create', 'uses' => 'EducationTypeController@create']);
Route::put('educationTypes/{educationTypes}', ['as'=> 'educationTypes.update', 'uses' => 'EducationTypeController@update']);
Route::patch('educationTypes/{educationTypes}', ['as'=> 'educationTypes.update', 'uses' => 'EducationTypeController@update']);
Route::get('educationTypes/{id}/delete', array('as' => 'educationTypes.delete', 'uses' => 'EducationTypeController@getDelete'));
Route::get('educationTypes/{id}/confirm-delete', array('as' => 'educationTypes.confirm-delete', 'uses' => 'EducationTypeController@getModalDelete'));
Route::get('educationTypes/{educationTypes}', ['as'=> 'educationTypes.show', 'uses' => 'EducationTypeController@show']);
Route::get('educationTypes/{educationTypes}/edit', ['as'=> 'educationTypes.edit', 'uses' => 'EducationTypeController@edit']);

});


Route::group(array('prefix' => 'admin/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.'), function () {

Route::get('employerTypes', ['as'=> 'employerTypes.index', 'uses' => 'EmployerTypeController@index']);
Route::post('employerTypes', ['as'=> 'employerTypes.store', 'uses' => 'EmployerTypeController@store']);
Route::get('employerTypes/create', ['as'=> 'employerTypes.create', 'uses' => 'EmployerTypeController@create']);
Route::put('employerTypes/{employerTypes}', ['as'=> 'employerTypes.update', 'uses' => 'EmployerTypeController@update']);
Route::patch('employerTypes/{employerTypes}', ['as'=> 'employerTypes.update', 'uses' => 'EmployerTypeController@update']);
Route::get('employerTypes/{id}/delete', array('as' => 'employerTypes.delete', 'uses' => 'EmployerTypeController@getDelete'));
Route::get('employerTypes/{id}/confirm-delete', array('as' => 'employerTypes.confirm-delete', 'uses' => 'EmployerTypeController@getModalDelete'));
Route::get('employerTypes/{employerTypes}', ['as'=> 'employerTypes.show', 'uses' => 'EmployerTypeController@show']);
Route::get('employerTypes/{employerTypes}/edit', ['as'=> 'employerTypes.edit', 'uses' => 'EmployerTypeController@edit']);

});


Route::group(array('prefix' => 'admin/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.'), function () {

Route::get('projectCategories', ['as'=> 'projectCategories.index', 'uses' => 'ProjectCategoryController@index']);
Route::post('projectCategories', ['as'=> 'projectCategories.store', 'uses' => 'ProjectCategoryController@store']);
Route::get('projectCategories/create', ['as'=> 'projectCategories.create', 'uses' => 'ProjectCategoryController@create']);
Route::put('projectCategories/{projectCategories}', ['as'=> 'projectCategories.update', 'uses' => 'ProjectCategoryController@update']);
Route::patch('projectCategories/{projectCategories}', ['as'=> 'projectCategories.update', 'uses' => 'ProjectCategoryController@update']);
Route::get('projectCategories/{id}/delete', array('as' => 'projectCategories.delete', 'uses' => 'ProjectCategoryController@getDelete'));
Route::get('projectCategories/{id}/confirm-delete', array('as' => 'projectCategories.confirm-delete', 'uses' => 'ProjectCategoryController@getModalDelete'));
Route::get('projectCategories/{projectCategories}', ['as'=> 'projectCategories.show', 'uses' => 'ProjectCategoryController@show']);
Route::get('projectCategories/{projectCategories}/edit', ['as'=> 'projectCategories.edit', 'uses' => 'ProjectCategoryController@edit']);

});


Route::group(array('prefix' => 'admin/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.'), function () {

Route::get('projectStatuses', ['as'=> 'projectStatuses.index', 'uses' => 'ProjectStatusController@index']);
Route::post('projectStatuses', ['as'=> 'projectStatuses.store', 'uses' => 'ProjectStatusController@store']);
Route::get('projectStatuses/create', ['as'=> 'projectStatuses.create', 'uses' => 'ProjectStatusController@create']);
Route::put('projectStatuses/{projectStatuses}', ['as'=> 'projectStatuses.update', 'uses' => 'ProjectStatusController@update']);
Route::patch('projectStatuses/{projectStatuses}', ['as'=> 'projectStatuses.update', 'uses' => 'ProjectStatusController@update']);
Route::get('projectStatuses/{id}/delete', array('as' => 'projectStatuses.delete', 'uses' => 'ProjectStatusController@getDelete'));
Route::get('projectStatuses/{id}/confirm-delete', array('as' => 'projectStatuses.confirm-delete', 'uses' => 'ProjectStatusController@getModalDelete'));
Route::get('projectStatuses/{projectStatuses}', ['as'=> 'projectStatuses.show', 'uses' => 'ProjectStatusController@show']);
Route::get('projectStatuses/{projectStatuses}/edit', ['as'=> 'projectStatuses.edit', 'uses' => 'ProjectStatusController@edit']);

});


Route::group(array('prefix' => 'admin/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.'), function () {

Route::get('qualifications', ['as'=> 'qualifications.index', 'uses' => 'QualificationController@index']);
Route::post('qualifications', ['as'=> 'qualifications.store', 'uses' => 'QualificationController@store']);
Route::get('qualifications/create', ['as'=> 'qualifications.create', 'uses' => 'QualificationController@create']);
Route::put('qualifications/{qualifications}', ['as'=> 'qualifications.update', 'uses' => 'QualificationController@update']);
Route::patch('qualifications/{qualifications}', ['as'=> 'qualifications.update', 'uses' => 'QualificationController@update']);
Route::get('qualifications/{id}/delete', array('as' => 'qualifications.delete', 'uses' => 'QualificationController@getDelete'));
Route::get('qualifications/{id}/confirm-delete', array('as' => 'qualifications.confirm-delete', 'uses' => 'QualificationController@getModalDelete'));
Route::get('qualifications/{qualifications}', ['as'=> 'qualifications.show', 'uses' => 'QualificationController@show']);
Route::get('qualifications/{qualifications}/edit', ['as'=> 'qualifications.edit', 'uses' => 'QualificationController@edit']);

});


Route::group(array('prefix' => 'admin/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.'), function () {

Route::get('universities', ['as'=> 'universities.index', 'uses' => 'UniversityController@index']);
Route::post('universities', ['as'=> 'universities.store', 'uses' => 'UniversityController@store']);
Route::get('universities/create', ['as'=> 'universities.create', 'uses' => 'UniversityController@create']);
Route::put('universities/{universities}', ['as'=> 'universities.update', 'uses' => 'UniversityController@update']);
Route::patch('universities/{universities}', ['as'=> 'universities.update', 'uses' => 'UniversityController@update']);
Route::get('universities/{id}/delete', array('as' => 'universities.delete', 'uses' => 'UniversityController@getDelete'));
Route::get('universities/{id}/confirm-delete', array('as' => 'universities.confirm-delete', 'uses' => 'UniversityController@getModalDelete'));
Route::get('universities/{universities}', ['as'=> 'universities.show', 'uses' => 'UniversityController@show']);
Route::get('universities/{universities}/edit', ['as'=> 'universities.edit', 'uses' => 'UniversityController@edit']);

});


Route::group(array('prefix' => 'admin/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.'), function () {

Route::get('currencies', ['as'=> 'currencies.index', 'uses' => 'CurrencyController@index']);
Route::post('currencies', ['as'=> 'currencies.store', 'uses' => 'CurrencyController@store']);
Route::get('currencies/create', ['as'=> 'currencies.create', 'uses' => 'CurrencyController@create']);
Route::put('currencies/{currencies}', ['as'=> 'currencies.update', 'uses' => 'CurrencyController@update']);
Route::patch('currencies/{currencies}', ['as'=> 'currencies.update', 'uses' => 'CurrencyController@update']);
Route::get('currencies/{id}/delete', array('as' => 'currencies.delete', 'uses' => 'CurrencyController@getDelete'));
Route::get('currencies/{id}/confirm-delete', array('as' => 'currencies.confirm-delete', 'uses' => 'CurrencyController@getModalDelete'));
Route::get('currencies/{currencies}', ['as'=> 'currencies.show', 'uses' => 'CurrencyController@show']);
Route::get('currencies/{currencies}/edit', ['as'=> 'currencies.edit', 'uses' => 'CurrencyController@edit']);

});


Route::group(array('prefix' => 'admin/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.'), function () {

Route::get('languages', ['as'=> 'languages.index', 'uses' => 'LanguageController@index']);
Route::post('languages', ['as'=> 'languages.store', 'uses' => 'LanguageController@store']);
Route::get('languages/create', ['as'=> 'languages.create', 'uses' => 'LanguageController@create']);
Route::put('languages/{languages}', ['as'=> 'languages.update', 'uses' => 'LanguageController@update']);
Route::patch('languages/{languages}', ['as'=> 'languages.update', 'uses' => 'LanguageController@update']);
Route::get('languages/{id}/delete', array('as' => 'languages.delete', 'uses' => 'LanguageController@getDelete'));
Route::get('languages/{id}/confirm-delete', array('as' => 'languages.confirm-delete', 'uses' => 'LanguageController@getModalDelete'));
Route::get('languages/{languages}', ['as'=> 'languages.show', 'uses' => 'LanguageController@show']);
Route::get('languages/{languages}/edit', ['as'=> 'languages.edit', 'uses' => 'LanguageController@edit']);

});


Route::group(array('prefix' => 'admin/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.'), function () {

Route::get('locations', ['as'=> 'locations.index', 'uses' => 'LocationController@index']);
Route::post('locations', ['as'=> 'locations.store', 'uses' => 'LocationController@store']);
Route::get('locations/create', ['as'=> 'locations.create', 'uses' => 'LocationController@create']);
Route::put('locations/{locations}', ['as'=> 'locations.update', 'uses' => 'LocationController@update']);
Route::patch('locations/{locations}', ['as'=> 'locations.update', 'uses' => 'LocationController@update']);
Route::get('locations/{id}/delete', array('as' => 'locations.delete', 'uses' => 'LocationController@getDelete'));
Route::get('locations/{id}/confirm-delete', array('as' => 'locations.confirm-delete', 'uses' => 'LocationController@getModalDelete'));
Route::get('locations/{locations}', ['as'=> 'locations.show', 'uses' => 'LocationController@show']);
Route::get('locations/{locations}/edit', ['as'=> 'locations.edit', 'uses' => 'LocationController@edit']);

});


Route::group(array('prefix' => 'admin/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.'), function () {

Route::get('candidateRoles', ['as'=> 'candidateRoles.index', 'uses' => 'CandidateRoleController@index']);
Route::post('candidateRoles', ['as'=> 'candidateRoles.store', 'uses' => 'CandidateRoleController@store']);
Route::get('candidateRoles/create', ['as'=> 'candidateRoles.create', 'uses' => 'CandidateRoleController@create']);
Route::put('candidateRoles/{candidateRoles}', ['as'=> 'candidateRoles.update', 'uses' => 'CandidateRoleController@update']);
Route::patch('candidateRoles/{candidateRoles}', ['as'=> 'candidateRoles.update', 'uses' => 'CandidateRoleController@update']);
Route::get('candidateRoles/{id}/delete', array('as' => 'candidateRoles.delete', 'uses' => 'CandidateRoleController@getDelete'));
Route::get('candidateRoles/{id}/confirm-delete', array('as' => 'candidateRoles.confirm-delete', 'uses' => 'CandidateRoleController@getModalDelete'));
Route::get('candidateRoles/{candidateRoles}', ['as'=> 'candidateRoles.show', 'uses' => 'CandidateRoleController@show']);
Route::get('candidateRoles/{candidateRoles}/edit', ['as'=> 'candidateRoles.edit', 'uses' => 'CandidateRoleController@edit']);

});

Route::group(array('prefix' => 'admin/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.'), function () {
    Route::get('finance', ['as'=> 'finances.index', 'uses' => 'FinanceController@index']);
    Route::get('finance/edit/{id}', ['as'=> 'finances.edit', 'uses' => 'FinanceController@edit']);
    //Route::put('finance/{id}', ['as'=> 'finances.update', 'uses' => 'FinanceController@update']);
    Route::post('finance/assign-to-resource', 'FinanceController@assignToResource')->name('assign-to-resource');
    Route::get('job_finance', ['as'=> 'job_finance.index', 'uses' => 'FinanceController@jobFinance']);
    Route::get('job_finance/edit/{id}', ['as'=> 'job_finance.edit', 'uses' => 'FinanceController@jobFinanceEdit']);
    Route::post('job_finance/job-assign-to-resource', 'FinanceController@JobAssignToResource')->name('job-assign-to-resource');
});

Route::group(array('prefix' => 'admin/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.'), function () {
    
    Route::get('homePage', ['as'=> 'homePage.index', 'uses' => 'HomeController@index']);
    Route::post('homePage', ['as'=> 'homePage.store', 'uses' => 'HomeController@store']);
    Route::get('homePage/create', ['as'=> 'homePage.create', 'uses' => 'HomeController@create']);
    Route::put('homePage/{homePage}', ['as'=> 'homePage.update', 'uses' => 'HomeController@update']);
    Route::patch('homePage/{homePage}', ['as'=> 'homePage.update', 'uses' => 'HomeController@update']);
    Route::get('homePage/{id}/delete', array('as' => 'homePage.delete', 'uses' => 'HomeController@getDelete'));
    Route::get('homePage/{id}/confirm-delete', array('as' => 'homePage.confirm-delete', 'uses' => 'HomeController@getModalDelete'));
    Route::get('homePage/{homePage}', ['as'=> 'homePage.show', 'uses' => 'HomeController@show']);
    Route::get('homePage/{homePage}/edit', ['as'=> 'homePage.edit', 'uses' => 'HomeController@edit']);
});
