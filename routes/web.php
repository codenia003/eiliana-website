<?php
require_once 'web_builder.php';
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

Route::pattern('slug', '[a-z0-9- _]+');

Route::group(
    ['prefix' => 'admin', 'namespace' => 'Admin'],
    function () {

        // Error pages should be shown without requiring login
        Route::get(
            '404',
            function () {
                return view('admin/404');
            }
        );
        Route::get(
            '500',
            function () {
                return view('admin/500');
            }
        );
        // Lock screen
        Route::get('{id}/lockscreen', 'LockscreenController@show')->name('lockscreen');
        Route::post('{id}/lockscreen', 'LockscreenController@check')->name('lockscreen');
        // All basic routes defined here
        Route::get('login', 'AuthController@getSignin')->name('login');
        Route::get('signin', 'AuthController@getSignin')->name('signin');
        Route::post('signin', 'AuthController@postSignin')->name('postSignin');
        Route::post('signup', 'AuthController@postSignup')->name('admin.signup');
        Route::post('forgot-password', 'AuthController@postForgotPassword')->name('forgot-password');
        Route::get(
            'login2',
            function () {
                return view('admin/login2');
            }
        );


        // Register2
        Route::get(
            'register2',
            function () {
                return view('admin/register2');
            }
        );
        Route::post('register2', 'AuthController@postRegister2')->name('register2');

        // Forgot Password Confirmation
        //    Route::get('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm')->name('forgot-password-confirm');
        //    Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm');

        // Logout
        Route::get('logout', 'AuthController@getLogout')->name('admin.logout');

        // Account Activation
        Route::get('activate/{userId}/{activationCode}', 'AuthController@getActivate')->name('activate');
    }
);


Route::group(
    ['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'],
    function () {
        // GUI Crud Generator
        Route::get('generator_builder', 'JoshController@builder')->name('generator_builder');
        Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');
        Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');
        // Model checking
        Route::post('modelCheck', 'ModelcheckController@modelCheck');

        // Dashboard / Index
        // Route::get(
        //     '/',
        //     function () {
        //         return view('admin.index');
        //     }
        // )->name('dashboard');
        Route::get('/', 'JoshController@showHome')->name('dashboard');
        // crop demo
        Route::post('crop_demo', 'JoshController@cropDemo')->name('crop_demo');
        //Log viewer routes
        Route::get('log_viewers', 'Admin\LogViewerController@index')->name('log-viewers');
        Route::get('log_viewers/logs', 'Admin\LogViewerController@listLogs')->name('log_viewers.logs');
        Route::delete('log_viewers/logs/delete', 'Admin\LogViewerController@delete')->name('log_viewers.logs.delete');
        Route::get('log_viewers/logs/{date}', 'Admin\LogViewerController@show')->name('log_viewers.logs.show');
        Route::get('log_viewers/logs/{date}/download', 'Admin\LogViewerController@download')->name('log_viewers.logs.download');
        Route::get('log_viewers/logs/{date}/{level}', 'Admin\LogViewerController@showByLevel')->name('log_viewers.logs.filter');
        Route::get('log_viewers/logs/{date}/{level}/search', 'Admin\LogViewerController@search')->name('log_viewers.logs.search');
        Route::get('log_viewers/logcheck', 'Admin\LogViewerController@logCheck')->name('log-viewers.logcheck');
        //end Log viewer
        // Activity log
        Route::get('activity_log/data', 'JoshController@activityLogData')->name('activity_log.data');
        //    Route::get('/', 'JoshController@index')->name('index');
    }
);

Route::group(
    ['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin', 'as' => 'admin.'],
    function () {

        // User Management
        Route::group(
            ['prefix' => 'users'],
            function () {
                Route::get('data', 'UsersController@data')->name('users.data');
                Route::get('{user}/delete', 'UsersController@destroy')->name('users.delete');
                Route::get('{user}/confirm-delete', 'UsersController@getModalDelete')->name('users.confirm-delete');
                Route::get('{user}/restore', 'UsersController@getRestore')->name('restore.user');
                //        Route::post('{user}/passwordreset', 'UsersController@passwordreset')->name('passwordreset');
                Route::post('passwordreset', 'UsersController@passwordreset')->name('passwordreset');

            }
        );
        Route::resource('users', 'UsersController');

        /************
     * bulk import
    ****************************/
        Route::get('bulk_import_users', 'UsersController@import');
        Route::post('bulk_import_users', 'UsersController@importInsert');
        /****************
     bulk download
    **************************/
        Route::get('download_users/{type}', 'UsersController@downloadExcel');





        Route::get('deleted_users', ['before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'])->name('deleted_users');

        // Email System
        Route::group(
            ['prefix' => 'emails'],
            function () {
                Route::get('compose', 'EmailController@create');
                Route::post('compose', 'EmailController@store');
                Route::get('inbox', 'EmailController@inbox');
                Route::get('sent', 'EmailController@sent');
                Route::get('{email}', ['as' => 'emails.show', 'uses' => 'EmailController@show']);
                Route::get('{email}/reply', ['as' => 'emails.reply', 'uses' => 'EmailController@reply']);
                Route::get('{email}/forward', ['as' => 'emails.forward', 'uses' => 'EmailController@forward']);
            }
        );
        Route::resource('emails', 'EmailController');

        // Role Management
        Route::group(
            ['prefix' => 'roles'],
            function () {
                Route::get('{group}/delete', 'RolesController@destroy')->name('roles.delete');
                Route::get('{group}/confirm-delete', 'RolesController@getModalDelete')->name('roles.confirm-delete');
                Route::get('{group}/restore', 'RolesController@getRestore')->name('roles.restore');
            }
        );
        Route::resource('roles', 'RolesController');

        /*routes for blog*/
        Route::group(
            ['prefix' => 'blog'],
            function () {
                Route::get('{blog}/delete', 'BlogController@destroy')->name('blog.delete');
                Route::get('{blog}/confirm-delete', 'BlogController@getModalDelete')->name('blog.confirm-delete');
                Route::get('{blog}/restore', 'BlogController@restore')->name('blog.restore');
                Route::post('{blog}/storecomment', 'BlogController@storeComment')->name('storeComment');
            }
        );
        Route::resource('blog', 'BlogController');

        /*routes for blog category*/
        Route::group(
            ['prefix' => 'blogcategory'],
            function () {
                Route::get('{blogCategory}/delete', 'BlogCategoryController@destroy')->name('blogcategory.delete');
                Route::get('{blogCategory}/confirm-delete', 'BlogCategoryController@getModalDelete')->name('blogcategory.confirm-delete');
                Route::get('{blogCategory}/restore', 'BlogCategoryController@getRestore')->name('blogcategory.restore');
            }
        );
        Route::resource('blogcategory', 'BlogCategoryController');
        /*routes for file*/
        Route::group(
            ['prefix' => 'file'],
            function () {
                Route::post('create', 'FileController@store')->name('store');
                Route::post('createmulti', 'FileController@postFilesCreate')->name('postFilesCreate');
                //        Route::delete('delete', 'FileController@delete')->name('delete');
                Route::get('{id}/delete', 'FileController@destroy')->name('file.delete');
                Route::get('data', 'FileController@data')->name('file.data');
                Route::get('{user}/delete', 'FileController@destroy')->name('users.delete');
            }
        );

        /*routes for News*/
        Route::group(
            ['prefix' => 'news'],
            function () {
                Route::get('data', 'NewsController@data')->name('news.data');
                Route::get('{news}/delete', 'NewsController@destroy')->name('news.delete');
                Route::get('{news}/confirm-delete', 'NewsController@getModalDelete')->name('news.confirm-delete');
            }
        );
        Route::resource('news', 'NewsController');

        Route::get(
            'crop_demo',
            function () {
                return redirect('admin/imagecropping');
            }
        );


        /* laravel example routes */
        // Charts
        Route::get('laravel_charts', 'ChartsController@index')->name('laravel_charts');
        Route::get('database_charts', 'ChartsController@databaseCharts')->name('database_charts');

        // datatables
        Route::get('datatables', 'DataTablesController@index')->name('index');
        Route::get('datatables/data', 'DataTablesController@data')->name('datatables.data');

        // datatables
        Route::get('jtable/index', 'JtableController@index')->name('index');
        Route::post('jtable/store', 'JtableController@store')->name('store');
        Route::post('jtable/update', 'JtableController@update')->name('update');
        Route::post('jtable/delete', 'JtableController@destroy')->name('delete');



        // SelectFilter
        Route::get('selectfilter', 'SelectFilterController@index')->name('selectfilter');
        Route::get('selectfilter/find', 'SelectFilterController@filter')->name('selectfilter.find');
        Route::post('selectfilter/store', 'SelectFilterController@store')->name('selectfilter.store');

        // editable datatables
        Route::get('editable_datatables', 'EditableDataTablesController@index')->name('index');
        Route::get('editable_datatables/data', 'EditableDataTablesController@data')->name('editable_datatables.data');
        Route::post('editable_datatables/create', 'EditableDataTablesController@store')->name('store');
        Route::post('editable_datatables/{id}/update', 'EditableDataTablesController@update')->name('update');
        Route::get('editable_datatables/{id}/delete', 'EditableDataTablesController@destroy')->name('editable_datatables.delete');

        //    # custom datatables
        Route::get('custom_datatables', 'CustomDataTablesController@index')->name('index');
        Route::get('custom_datatables/sliderData', 'CustomDataTablesController@sliderData')->name('custom_datatables.sliderData');
        Route::get('custom_datatables/radioData', 'CustomDataTablesController@radioData')->name('custom_datatables.radioData');
        Route::get('custom_datatables/selectData', 'CustomDataTablesController@selectData')->name('custom_datatables.selectData');
        Route::get('custom_datatables/buttonData', 'CustomDataTablesController@buttonData')->name('custom_datatables.buttonData');
        Route::get('custom_datatables/totalData', 'CustomDataTablesController@totalData')->name('custom_datatables.totalData');

        //tasks section
        Route::post('task/create', 'TaskController@store')->name('store');
        Route::get('task/data', 'TaskController@data')->name('data');
        Route::post('task/{task}/edit', 'TaskController@update')->name('update');
        Route::post('task/{task}/delete', 'TaskController@delete')->name('delete');
    }
);

// Remaining pages will be called from below controller method
// in real world scenario, you may be required to define all routes manually

Route::group(
    ['prefix' => 'admin', 'middleware' => 'admin'],
    function () {
        Route::get('{name?}', 'JoshController@showView');
    }
);

// FrontEndController

// frontend views
// Route::get(
//     '/',
//     ['as' => 'home', function () {
//         return view('comingsoon');
//     }]
// );
// Route::get(
//     '/',
//     ['as' => 'home', function () {
//         return view('index');
//     }]
// );
Route::get('/', 'HomeController@index')->name('/');
Route::get('ip_details', 'HomeController@getipdetails');

// account
Route::group(
    // ['prefix' => 'account', 'middleware' => 'throttle:10|60,5'],
    ['prefix' => 'account'],
    function () {

        Route::get('register', 'AuthController@getRegister')->name('register');
        Route::post('register', 'AuthController@postRegister')->name('register');

        Route::get('registerotp', 'AuthController@getregisterotp')->name('registerotp');
        Route::post('registerotp', 'AuthController@postregisterotp')->name('registerotp');
        Route::post('resendotp', 'AuthController@postresendotp')->name('resendotp');

        Route::get('registerbasic', 'AuthController@getregisterbasic')->name('registerbasic');
        Route::post('registerbasic', 'AuthController@postregisterbasic')->name('registerbasic');

        Route::get('loginfirst', 'AuthController@getloginfirst')->name('loginfirst');
        Route::post('loginfirst', 'AuthController@postloginfirst')->name('loginfirst');

        Route::get('login', 'AuthController@getLogin')->name('login');
        Route::post('login', 'AuthController@postLogin')->name('login');

        Route::get('loginas', 'AuthController@getLoginAs')->name('loginas');
        Route::post('loginas', 'AuthController@postLoginAs')->name('loginas');

        Route::get('activate/{userId}/{activationCode}', 'FrontEndController@getActivate')->name('activate');

        Route::get('forgot-password', 'FrontEndController@getForgotPassword')->name('forgot-password');
        Route::post('forgot-password', 'FrontEndController@postForgotPassword');
    }
);

// Social Logins
Route::get('facebook', 'Admin\FacebookAuthController@redirectToProvider');
Route::get('facebook/callback', 'Admin\FacebookAuthController@handleProviderCallback');

Route::get('linkedin', 'Admin\LinkedinAuthController@redirectToProvider');
Route::get('linkedin/callback', 'Admin\LinkedinAuthController@handleProviderCallback');

Route::get('google', 'Admin\GoogleAuthController@redirectToProvider');
Route::get('google/callback', 'Admin\GoogleAuthController@handleProviderCallback');

// Forgot Password Confirmation
Route::post('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@postForgotPasswordConfirm');
Route::get('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@getForgotPasswordConfirm')->name('forgot-password-confirm');

// logout
Route::get('logout', 'FrontEndController@getLogout')->name('logout');

Route::get('DatabaseNotificationsMarkasRead', function () {
    Sentinel::getUser()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('databasenotifications.markasread');

// My account display and update details
Route::group(
    ['prefix' => 'profile', 'middleware' => 'user'],
    function () {
        Route::get('', 'ProfileController@basicInfo')->name('profile');
        Route::put('profile', 'ProfileController@update');

        // profile update
        Route::get('/publicAnonymusUpdate', 'ProfileController@publicAnonymusUpdate');
        Route::post('/updateProfile', 'ProfileController@updateProfile')->name('updateProfile');
        Route::post('/updateProfileResume', 'ProfileController@updateProfileResume')->name('updateProfileResume');
        Route::post('/uploadProfilePic', 'ProfileController@uploadProfilePic');

        Route::get('addtional-info', 'ProfileController@addtionalInfo')->name('addtional-info');

        // education
        Route::get('education', 'ProfileController@education')->name('education');
        Route::post('/registereducation', 'ProfileController@registerEducation');
        Route::get('/deleteducation', 'ProfileController@deleteEducation');
        // Route::get('education/education-add', 'ProfileController@educationAdd')->name('education/education-add');
        // Route::get('education/education-edit/{id}', 'ProfileController@educationEdit');

        Route::get('certification', 'ProfileController@certification')->name('certification');
        Route::post('/registercertification', 'ProfileController@registerCertification');
        Route::get('/deletecertification', 'ProfileController@deleteCertification');
        // Route::get('certification/certification-add', 'ProfileController@certificationAdd');

        Route::get('professional-experience', 'ProfileController@professionalExperience')->name('professional-experience');
        Route::post('registerprofexp', 'ProfileController@resgiterProfessionalExperience')->name('professional-experience');

        Route::get('projects', 'ProfileController@projects')->name('projects');
        Route::post('registerprojects', 'ProfileController@registerProjects')->name('registerprojects');
        Route::get('deleteprojects', 'ProfileController@deleteProjects');

        Route::get('employer', 'ProfileController@employer')->name('employer');
        Route::post('registeremployer', 'ProfileController@registeremployer')->name('registeremployer');
        Route::get('deleteemployer', 'ProfileController@deleteemployer');

        Route::get('tax', 'ProfileController@tax')->name('tax');
        Route::get('financial', 'ProfileController@financial')->name('financial');

        Route::get('change-password', 'ProfileController@getChangePassword')->name('change-password');
        Route::post('change-password', 'ProfileController@postChangePassword');
    }
);

Route::group(
    ['middleware' => ['user', 'profilefill']],
    function () {
        Route::get('home', 'FrontEndController@getDashboard')->name('home');
        Route::get('post-job', 'JobController@index')->name('post-job');
        Route::post('post-job-on', 'JobController@postJobon')->name('post-job-on');
        Route::post('confirmation-post-job', 'JobController@confirmationPostJobon')->name('confirmation-post-job');
        Route::get('post-project', 'ProjectController@postProject')->name('post-project');
        Route::post('confirmation-post-project', 'ProjectController@confirmationPostProjecton')->name('confirmation-post-project');
        Route::post('post-project-on', 'ProjectController@postProjecton')->name('post-project-on');

        Route::get('project/{id}', 'ProjectController@getProjectDeatils')->name('project.view');
        Route::get('job/{id}', 'JobController@getJobDeatils')->name('jobdetails');
        Route::get('profile/{id}', 'JobController@getProfileDeatils')->name('profile.view');
        Route::get('resume/', 'JobController@getResume')->name('resume.view');

        Route::post('post-staffing-lead', 'JobController@postStaffingLead');
        Route::get('staffing-lead-response/{id}', 'JobController@staffingLeadResponse');
        Route::post('staffing-lead-convert', 'JobController@staffingLeadConvert');

        Route::post('post-sales-referral-to-eiliana', 'JobController@postSalesReferralContactEiliana')->name('post-sales-referral-to-eiliana');

        Route::get('sales-referral-form', 'SalesController@salesReferralForm');
        Route::post('sales/post-referral-form', 'SalesController@postSalesReferralForm')->name('referralform');
        Route::get('sales/identifyconsultant', 'SalesController@identifyconsultant');

        Route::get('sales-referral-modify-form/{id}', 'SalesController@ModifySalesReferralForm');
        Route::post('sales/update-referral-form', 'SalesController@updateSalesReferralForm')->name('updateReferralform');

        Route::get('user-type', 'ProjectController@userSliderType')->name('user-type');
        Route::get('user-type/{slug}', 'ProjectController@userType')->name('user-type-slug');

        Route::get('freelancer-referral', 'SalesController@freelancerReferralView')->name('freelancerreferral');
        Route::post('freelancer-referral', 'SalesController@freelancerReferral')->name('freelancerreferral.new');
        Route::post('freelancer-referral-email', 'SalesController@freelancerReferralEmail');
        Route::post('freelancer-referral-accept/{referral_code}', 'SalesController@freelancerReferralAccept')->name('freelancerreferral.accept');
    }
);

Route::group(
    ['prefix' => 'job', 'middleware' => ['user', 'profilefill']],
    function () {
        Route::get('job-apply/{id}', 'JobController@jobApplyLead')->name('joblead.view');
        Route::post('post-job-lead', 'JobController@postJobLead')->name('postJobLead.new');
        Route::get('lead-response/{id}', 'JobController@jobApplyLeadResponse')->name('joblead.resposne');

        Route::get('job-lead-response/{id}', 'JobController@jobLeadResponse');
        Route::get('profilejoblead/{id}', 'JobController@profileJobLead')->name('job.profilejoblead');
        Route::get('job-contract-details/{id}', 'JobController@JobContractDetails')->name('job-contract-details');
        Route::post('post-job-contract', 'JobController@postJobContract')->name('jobcontract.create');
        Route::post('job-lead-convert', 'JobController@jobLeadConvert');
        Route::get('job-finance/{id}', 'JobController@jobFinance')->name('job-finance');
        Route::post('job-send-finance', 'JobController@sendJobFinance')->name('job-finance.send');

        Route::post('save-job', 'JobController@SaveJob')->name('save-job');
        Route::post('assign-job', 'JobController@assignJob')->name('assignJob');

        Route::get('job-schedule-modify/{id}', 'JobController@ContractualJobInformModify')->name('job-schedule-modify');
        Route::post('update-job-schedule', 'JobController@updateJobSchedule')->name('jobschedule.update-modify');
    }
);

Route::group(
    ['prefix' => 'chat', 'middleware' => ['user', 'profilefill']],
    function () {
        Route::post('fetch_chat_history', 'ChatController@fetchChatHistory')->name('fetch_chat_history');
        Route::post('insert_chat', 'ChatController@insertChat')->name('insert_chat');
    }
);

Route::group(
    ['prefix' => 'client', 'middleware' => ['user', 'profilefill']],
    function () {
        Route::get('my-lead', 'ClientController@myLead')->name('my-lead');
        Route::get('my-lead/{id}', 'ClientController@myLeadView')->name('my-lead.view');

        Route::get('my-requirement-job', 'ClientController@myRequirementJob')->name('my-requirement-job');
        Route::get('my-requirement-project', 'ClientController@myRequirementProject')->name('my-requirement-project');
        Route::post('job-status-change', 'ClientController@postJobStatus')->name('job-status-change');

        Route::get('my-job-lead/{id}', 'ClientController@myJobLeadView')->name('my-job-lead.view');
        Route::post('proposal-job-status-change', 'ClientController@proposalJobStatus')->name('proposal-job-status-change');

        Route::post('project-status-change', 'ClientController@postProjectStatus')->name('project-status-change');
        Route::post('proposal-project-status-change', 'ClientController@proposalProjectStatus')->name('proposal-project-status-change');
        Route::get('my-requirement/{id}', 'ClientController@myRequirementView')->name('my-requirement.view');

        Route::get('my-delivery-job', 'ClientController@myDeliveryJob')->name('my-delivery-job');
        Route::get('my-delivery-project', 'ClientController@myDeliveryProject')->name('my-delivery-project');

        Route::get('my-proposal', 'ClientController@myProposal')->name('my-proposal');
        Route::get('my-proposal/{id}', 'ClientController@myProposalView')->name('my-proposal.view');
        Route::get('my-project-lead/{id}', 'ClientController@myProjectLeadView')->name('my-project-lead.view');
        Route::post('post-proposal-job-lead', 'ClientController@postProposalJobLead');
        Route::get('my-project', 'ClientController@myProject')->name('my-project');

        Route::get('resource-details-form/{id}', 'ClientController@resourceDetailsForm')->name('resource-details-form');
        Route::post('post-resource-details', 'ClientController@postResourceDetails')->name('post-resource-details');

        Route::get('project-schedule/{id}', 'ClientController@projectSchedule')->name('project-schedule');
        Route::post('project-lead-schedule', 'ClientController@projectLeadSchedule')->name('project-lead-schedule');

        Route::post('project-schedule-module-status', 'ClientController@projectScheduleModuleStatus')->name('project-schedule-module-status');

        Route::get('project-contract-details/{id}', 'ClientController@projectContractDetails')->name('projectcontractdetails');
        Route::post('project-contract-post', 'ClientController@postProjectContractDetails')->name('project-contract-post');
        Route::post('project-contract-payment', 'ClientController@postProjectContractPayment')->name('project-contract-payment');

        Route::get('project-retainer-contract-details/{id}', 'ClientController@projectRetainerContractDetails')->name('projectretainercontractdetails');
        Route::post('project-retainer-contract-payment', 'ClientController@postRetainerProjectContractPayment')->name('project-retainer-contract-payment');

        Route::get('project-payment/{id}', 'ClientController@projectPayments')->name('projectpayment');
        Route::post('contractual-job-lead-schedule', 'ClientController@ContractualJobLeadSchedule')->name('contractual-job-lead-schedule');
        Route::get('contractual-job-inform/{id}', 'ClientController@ContractualJobInform')->name('contractual-job-inform.create');

        Route::get('job-contract-details/{id}', 'ClientController@jobContractDetails')->name('jobcontractdetails');
        Route::post('job-contract-post', 'ClientController@postJobContractDetails')->name('job-contract-post');
        Route::post('contractual-job-payment', 'ClientController@postContractualJobPayment')->name('contractual-job-payment');

        Route::get('invoice',array('as'=>'invoice','uses'=>'ClientController@GenerateInvoice'));
        Route::get('my-contract-job', 'ClientController@myContractJob')->name('my-contract-job');

        Route::get('project-revise/{id}', 'ClientController@projectReviseProposal')->name('projectrevise.view');
        Route::post('project-revise-proposal', 'ClientController@postProjectReviseProposal')->name('project-revise-proposal');

        Route::post('job-onboarding', 'ClientController@postJobOnboarding')->name('job-onboarding');

    }
);

Route::group(
    ['prefix' => 'freelancer', 'middleware' => ['user', 'profilefill']],
    function () {
        Route::get('my-lead', 'FreelancerController@myLead')->name('my-lead');
        Route::get('my-opportunity', 'FreelancerController@myOpportunity')->name('my-opportunity');
        Route::get('my-opportunity/{id}', 'FreelancerController@myOpportunityView')->name('my-opportunity.view');
        Route::get('my-proposal', 'FreelancerController@myProposal')->name('my-proposal');
        Route::get('my-proposal/{id}', 'FreelancerController@myProposalView')->name('my-proposal.view');
        Route::get('my-project', 'FreelancerController@myProject')->name('my-project');

        Route::get('my-project-schedule/{id}', 'FreelancerController@projectSchedule')->name('project-schedule.my');
        Route::post('project-schedule-update', 'FreelancerController@projectScheduleUpdate')->name('project-schedule-update');
        Route::post('post-project-schedule', 'FreelancerController@postProjectSchedule')->name('projectschedule.update');

        Route::get('next-project-schedule/{id}', 'FreelancerController@nextProjectScheduleModule')->name('next-project-schedule');

        Route::get('recommend', ['as'=> 'recommend.index', 'uses' => 'RecommendController@index']);
        Route::post('recommandStore', 'RecommendController@store')->name('recommandStore');

        Route::get('contractual-job-inform/{id}', 'FreelancerController@ContractualJobInform')->name('contractual-job-inform.create');
        Route::post('post-contractual-job-inform', 'FreelancerController@postContractualJobInform')->name('contractual-job-inform.store');
        Route::get('my-save-job', 'FreelancerController@mySaveJob')->name('my-save-job');

        Route::get('my-contract_job', 'FreelancerController@myJobProposal')->name('my-contract_job');
        Route::post('post-proposal-job-lead', 'FreelancerController@postProposalJobLead');

        Route::get('delivery-contract-job', 'FreelancerController@myDeliveryJob')->name('delivery-contract-job');
        Route::get('delivery-project', 'FreelancerController@myDeliveryProject')->name('delivery-project');
        Route::get('delivery-project/{id}', 'FreelancerController@myDeliveryProjectView')->name('delivery-project.view');

        Route::post('proposal-project-status-change', 'FreelancerController@proposalProjectStatus')->name('proposal-project-status-change');
        Route::post('proposal-job-status-change', 'FreelancerController@proposalJobStatus')->name('proposal-job-status-change');

    }
);

Route::group(
    ['prefix' => 'advance-search', 'middleware' => ['user', 'profilefill']],
    function () {
        Route::get('jobs', 'AdvanceSearchController@jobs')->name('jobs');
        Route::post('jobs', 'AdvanceSearchController@jobs')->name('jobs');
        Route::get('projects', 'AdvanceSearchController@projects')->name('projects');
        Route::post('projects', 'AdvanceSearchController@projects')->name('projects');
        Route::get('contract-staffing', 'AdvanceSearchController@contractStaffing')->name('contract-staffing');
        Route::post('contract-staffing', 'AdvanceSearchController@contractStaffing')->name('contract-staffing');
    }
);

Route::group(
    ['middleware' => 'user'],
    function () {
        Route::get('welcome', 'InformationController@welcome')->name('welcome');

    }   
);

Route::group(
    ['prefix' => 'company', 'middleware' => ['user', 'company', 'profilefill']],
    function () {
        Route::get('bench', 'CompanayController@index');
        Route::get('teams', 'CompanayController@teamsForm');
        Route::post('registerteams', 'CompanayController@registerTeams')->name('registerteams');
    }
);

Route::get('acceptinvitation', 'CompanayController@acceptInvitation')->name('acceptinvitation');


// Email System
Route::group(
    ['prefix' => 'user_emails'],
    function () {
        Route::get('compose', 'UsersEmailController@create');
        Route::post('compose', 'UsersEmailController@store');
        Route::get('inbox', 'UsersEmailController@inbox');
        Route::get('sent', 'UsersEmailController@sent');
        Route::get('{email}', ['as' => 'user_emails.show', 'uses' => 'UsersEmailController@show']);
        Route::get('{email}/reply', ['as' => 'user_emails.reply', 'uses' => 'UsersEmailController@reply']);
        Route::get('{email}/forward', ['as' => 'user_emails.forward', 'uses' => 'UsersEmailController@forward']);
    }
);

Route::resource('user_emails', 'UsersEmailController');
// client seaech and post
Route::get('hire-talent', 'JobController@hireTalent')->name('hire-talent');
Route::get('hire-talent/{slug}', 'JobController@categoryDetails')->name('hire-talent-slug');
Route::get('hire-talent-sales', 'JobController@hireTalentSales')->name('hire-talent-sales');
Route::post('talent-search', 'JobController@talentSearch')->name('talent-search');
Route::get('job-posting', 'JobController@jobProject')->name('job-posting');
Route::post('job-posting-search', 'JobController@jobPostingSearch')->name('job-posting');

// feeelancer
Route::get('search-project', 'ProjectController@getSearchProject')->name('search-project');
Route::get('search-project/{slug}', 'ProjectController@categoryDetails')->name('search-project-slug');

Route::get('/getframework', 'ProfileController@getframework');
Route::get('/getprojectcategory', 'ProjectController@getProjectCategory');

// contact form
Route::post('contact', 'FrontEndController@postContact')->name('contact');

// blog
Route::get('blog', 'BlogController@index')->name('blog');
Route::get('blogdetail', 'BlogController@blogdetail')->name('blogdetails');
Route::get('blog/{slug}/tag', 'BlogController@getBlogTag');
Route::get('blogitem/{slug?}', 'BlogController@getBlog');
Route::post('blogitem/{blog}/comment', 'BlogController@storeComment');

//news
Route::get('news', 'NewsController@index')->name('news');
Route::get('news/{news}', 'NewsController@show')->name('news.show');

//info
Route::get('sales-referral', 'SalesController@salesReferral');
Route::get('about', 'InformationController@about')->name('about');
Route::get('careers', 'InformationController@careers')->name('careers');
Route::get('customers', 'InformationController@customers')->name('customers');
Route::get('hire-us', 'InformationController@hireUs')->name('hire-us');
Route::get('privacy-policy', 'InformationController@privacy')->name('privacypolicy');
Route::get('terms-and-conditions', 'InformationController@termsAndConditions')->name('termsandconditions');
Route::get('how-its-work', 'InformationController@howItsWork')->name('howitswork');
Route::get('help', 'InformationController@help')->name('help');
Route::get('pricing-plan', 'InformationController@pricingPlan')->name('pricingplan');
Route::get('teams', 'InformationController@teams')->name('teams');
Route::get('contact-us', 'InformationController@contactUs')->name('contact-us');
Route::post('contact-us-post', 'InformationController@contactUsSave')->name('contact-us-post');
Route::get('sitemap', 'InformationController@siteMap')->name('sitemap');

// Route::get('{name?}', 'FrontEndController@showFrontEndView');
// End of frontend views
