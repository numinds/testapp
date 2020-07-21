<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

//bd jul_12 -- test/update -- laravel 7
//bd -- for the laravel/helper
use Illuminate\Support\Str;

use App;
use App\User;
use Config;
use Event;
use Log;
use Request;
use Mail;
use Session;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
//bd	public function boot(DispatcherContract $events)
        public function boot()
	{
//bd		parent::boot($events);
                parent::boot();

		User::creating(function($user)
		{
			$user->ip_address = Request::ip();

//bd		$user->confirmation_code = str_random(60);
//bd		$user->referral_code = str_random(10);
//bd		$user->referral_secret = str_random(10);

			$user->confirmation_code = Str::random(60);
			$user->referral_code = Str::random(10);
			$user->referral_secret = Str::random(10);

			Session::put(Config::get('prelaunch.session:referral_secret'), $user->referral_secret);
		});

		User::created(function($user)
		{
			$user->sendConfirmation();
		});

		# query logger
		if(App::environment('local'))
		{
			Event::listen('illuminate.query', function($sql,$bindings,$time) {
				for ($i = 0; $i < sizeof($bindings); $i++) {
					if ($bindings[$i] instanceof DateTime) {
						$bindings[$i]= $bindings[$i]->getTimestamp();
					}
				}
				Log::info(sprintf("%s (%s) : %s",$sql,implode(",",$bindings),$time));
			});

		}
	}

}


