<?php namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
         * @param  \Throwable  $e
	 * @param  \Exception  $e
	 * @return void
	 */

function convert($size)
{
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

        //public function report(Exception $e)
	public function report(Throwable $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
         * @param  \Throwable  $e
	 * //@param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
        //public function render($request, Exception $e)
	public function render($request, Throwable $e)
	{

//		$fp = fopen('/home/test/pl/public/aa.txt', 'w'); 
//		fwrite($fp, "dddd\n"); 
		#fclose($fp); 

        if($this->isHttpException($e))
		{
		#$fp = fopen('/var/www/html/rtest/public/aa.txt', 'w'); 
//		fwrite($fp, "render http\n"); 
exec('echo " handler isHttpException" >> /home/test/pl/aa.txt');
		}
		else
		{
		#$fp = fopen('/var/www/html/rtest/public/aa.txt', 'w'); 
//		fwrite($fp, "not http\n"); 
exec('echo " handler not  isHttpException" >> /home/test/pl/aa.txt');

		}

//		fclose($fp); 
		//if ($e->getStatusCode() == 503)

//bd test to figure out getStatusCode
//print_r($e);
//exec('echo "aaa" >> /home/test/pl/aa.txt');
$r=$this->convert(memory_get_usage(true));
exec('echo " handler '.$r.'" >> /home/test/pl/aa.txt');
unset($r);
//die();
//exit;
exec('echo " handler b4 stat code" >> /home/test/pl/aa.txt');

/*
		if ($e->getStatusCode() == 503)
		{
exec('echo " handler inside stat code  render" >> /home/test/pl/aa.txt');
			return parent::render($request, $e);
		}
*/
		
exec('echo " handler b4 render" >> /home/test/pl/aa.txt');
		// just redirect to the homepage for all errors

//--per lagbox -- laravel IRC  as a test
// return parent::render($request, $e);

		return redirect()->route('user.create.nostatus');
	}


}


