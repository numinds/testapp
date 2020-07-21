<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class myTestEmailClass extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    //private string $token;
    //private string $secret;
    public $token;
    public $secret;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    //public function __construct(string $token)
    //public function __construct(string $this->confirmation_code) //from the EventServiceProvider.php
    public function __construct($data) //from the EventServiceProvider.php
    {
        //
		//$this->token = $token;	
		$this->token = $data->confirmation_code;	
		$this->secret = $data->referral_secret;

exec('echo "mytest cons  token '.$this->token.'" >> /home/test/pl/aa.txt');
exec('echo "mytest cons  secret '.$this->secret.'" >> /home/test/pl/aa.txt');

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
exec('echo "mytest build  token '.$this->token.'" >> /home/test/pl/aa.txt');
exec('echo "mytest build  secret '.$this->secret.'" >> /home/test/pl/aa.txt');
//exec('echo "mytest build  token 11 '.$token.'" >> /home/test/pl/aa.txt');
//exec('echo "mytest build  secret 11 '.$secret.'" >> /home/test/pl/aa.txt');


        //return $this->view('emails.confirm');
        return $this
            ->subject('Welcome!')
            ->view('emails.confirm')
            ->with(['token' => $this->token,
                    'secret' => $this->secret
                   ]);

    }
}


/*
test- the Mail::queue was initially in the User.php file
commented out here.. to track what the initial vars are/were..
-the vars are set in the mailable above
-the mailable is (hopefully) instantiated in the User.php in the Mail::to .... process
-the view -- emails.confirm 

		Mail::queue('emails.confirm', [ 'token' => $this->confirmation_code, 'secret' => $this->referral_secret ],

		$email = $this->email;
		$name = $this->name;
		Mail::queue('emails.confirm', [ 'token' => $this->confirmation_code, 'secret' => $this->referral_secret ], function($message) use ($email, $name) 
		{
			$message->to($email, $name)->subject('Welcome to MidwestFit!');
		});	



Mail::to($email)->queue(new myTestEmailClass);

Mail::to('user@domain.tld')->queue(new MyEmail);

		Mail::queue('emails.confirm', [ 'token' => $this->confirmation_code, 'secret' => $this->referral_secret ], function($message) use ($email, $name) 
		{
			$message->to($email, $name)->subject('Welcome to MidwestFit!');
		});	
*/

