<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @return void
	 */
	public function __construct(Guard $auth, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;

		//bd $this->middleware('guest');
                $this->middleware('guest', ['except' => [ 'getEmail', 'postEmail', 'getReset', 'postReset' ]]);

	}

        /**
         * Get email - no clue what/how the func should work
         *      -the initial controller had no funcs..
         *      -make this a stub for now
         *      -match the route.php -- password
         *
         */
        public function getEmail()
        {
        }


        /**
         * Post email - no clue what/how the func should work
         *      -the initial controller had no funcs..
         *      -make this a stub for now
         *      -match the route.php -- password
         *
         */
        public function postEmail()
        {
        }


        /**
         * Get reset - no clue what/how the func should work
         *      -the initial controller had no funcs..
         *      -make this a stub for now
         *      -match the route.php -- password
         *
         */
        public function getReset()
        {
        }


        /**
         * Post reset - no clue what/how the func should work
         *      -the initial controller had no funcs..
         *      -make this a stub for now
         *      -match the route.php -- password
         *
         */
        public function postReset()
        {
        }

}
