<?php

namespace App\Providers;

use App\Models\Email;
use App\Models\ProjectCategory;
use App\Models\User;
use Sentinel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Activity;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using Closure based composers...
        View::composer(
            ['admin.layouts.default','admin.layouts.horizontal','admin.minisidebar','admin.emails.*','layouts.default','user_emails.*'],
            function ($view) {
                if (Sentinel::check()) {
                    $inbox_emails =  Email::where('status', 1)->where('email_id', Sentinel::getUser()->email)->get();
                    $ids=[];
                    foreach ($inbox_emails as $email) {
                        if (User::where('id', $email->user_id)->exists()) {
                            $ids[]=$email->id;
                        }
                    }
                    $notifications = Email::whereIn('id', $ids)->get();
                    view()->share(['count'=> $notifications->count()]);
                    $view->with('notifications', $notifications);
                } else {
                    view()->share(['count'=> 0]);
                }
            }
        );

        View::composer('layouts.default', function($view) {
            $projectcategory = ProjectCategory::where('parent_id' , '0')->where('display_status', '1')->get();
            $view->with('categories', $projectcategory);
         });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
