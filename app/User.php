<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Mail\myTestEmailClass;


use Mail;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * Pseudo-attributes to append for admin
	 *
	 * @var string
	 */
	protected $appends = [ 'referral_url', 'referral_status_url' ];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function referrer()
	{
		return $this->belongsTo('App\User', 'referrer_id');
	}

	public function referrals()
	{
		return $this->hasMany('App\User', 'referrer_id');
	}

	public function confirmedReferrals()
	{
		return $this->hasMany('App\User', 'referrer_id')->whereValidEmail(true);
	}

	public function getReferralUrlAttribute()
	{
		return route('user.referral', [ $this->referral_code ]);
	}

	public function getReferralStatusUrlAttribute()
	{
		return route('user.status', [ $this->referral_secret ]);
	}

	public function setPasswordAttribute($value)
	{
		if ($value) 
		{
			$this->attributes['password'] = bcrypt($value);
		}
	}

	public function isAdmin()
	{
		return $this->role == 'ADMIN';
	}

	public function sendConfirmation()
	{
		$email = $this->email;
		$name = $this->name;

/*
 		Mail::queue('emails.confirm', [ 'token' => $this->confirmation_code, 'secret' => $this->referral_secret ], function($message) use ($email, $name) 
		{
			$message->to($email, $name)->subject('Welcome to MidwestFit!');
		});	
 */

$d1 = ['email' => $email,
         'name' => $name
        ];

$data=(object) $d1;

function convert($size)
{
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

$r=convert(memory_get_usage(true));
exec('echo "mail-to '.$r.'" >> /home/test/pl/aa.txt');

exec('echo "mail-to 1name '.$name.'" >> /home/test/pl/aa.txt');
exec('echo "mail-to 1email '.$email.'" >> /home/test/pl/aa.txt');

print_r($d1);
var_dump($d1);
exec('echo "mail-to name '.$d1['name'].'" >> /home/test/pl/aa.txt');
exec('echo "mail-to email '.$d1['email'].'" >> /home/test/pl/aa.txt');

print_r($data);
var_dump($data);
exec('echo "mail-to name '.$data->name.'" >> /home/test/pl/aa.txt');
exec('echo "mail-to email '.$data->email.'" >> /home/test/pl/aa.txt');

//			$user->confirmation_code = Str::random(60);
//			$user->referral_code = Str::random(10);
//			$user->referral_secret = Str::random(10);

exec('echo "user1 confirmation_code '.$this->confirmation_code.'" >> /home/test/pl/aa.txt');
///exec('echo "user2 confirmation_code '.$user->confirmation_code.'" >> /home/test/pl/aa.txt');
//exec('echo "user1 email '.$data->email.'" >> /home/test/pl/aa.txt');

//		Mail::to($email)->queue(new myTestEmailClass($data));
		Mail::to($email)->queue(new myTestEmailClass($this));

exec('echo "after mail-to '.$r.'" >> /home/test/pl/aa.txt');

/*
bd - jul 16
trying to implement the mailable for the Mail::to process
*/

	}

}

