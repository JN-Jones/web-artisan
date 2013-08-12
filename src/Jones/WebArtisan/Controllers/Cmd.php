<?php namespace Jones\WebArtisan\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Lang;
use \Jones\WebArtisan\Cli\Output;
use Illuminate\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Input\ArrayInput;

class Cmd extends \BaseController
{
	private $password = null;

	public function __construct()
	{
		if (!Config::get('web-artisan::enable'))
		{
			throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
		}

		if (Session::has('password'))
		{
			$this->password = Session::get('password');
		}
	}

	public function index()
	{
		return View::make('web-artisan::webartisan');
	}

	public function password()
	{
		$this->password = trim(Input::get('password'));
		Session::put('password', $this->password);
		if ($this->checkUser())
		{
			echo Lang::get('web-artisan::webartisan.terminal.loggedin');
			return;
		}
		echo Lang::get('web-artisan::webartisan.terminal.wrongpw');
    }

	public function run()
	{
		if (!$this->checkUser())
		{
			echo '<p>'.Lang::get('web-artisan::webartisan.terminal.needlogin').'</p>';
			return;
		}

		$parts = explode(" ", Input::get('cmd'));

		if(count($parts) < 2) // We need at least 2 entries: "artisan cmd"
		{
			echo '<p>'.Lang::get('web-artisan::webartisan.terminal.invalidcmd').'</p>';
			return;
		}

		//first is "artisan" so remove it
		unset($parts[0]);

		//second is the command
		$cmd = $parts[1];
		unset($parts[1]);

		$app = app();
		$app->loadDeferredProviders();
		$artisan = ConsoleApplication::start($app);

		$command = $artisan->find($cmd);

		$def = $command->getDefinition();
		$arguments = $def->getArguments();
		$fix = array();
		foreach($arguments as $argument)
		{
			$fix[] = $argument->getName();
		}
		$arguments = $fix;

		$params = array();
		//the rest should be the parameter list
		$i = 0; //The counter for our argument list
		foreach($parts as $param)
		{
			// foo=bar, we don't need to work more
			if(strpos($param, "=") !== false)
			{
				$param = explode("=", $param, 2);
				$params[$param[0]] = $param[1];
			}
			else
			{
				//Do we have an argument or an option?
				if(substr($param, 0, 1) == "-")
				{
					$params[$param] = true; //Option, simply set it to true
				}
				else
				{
					//Argument, we need a bit work
					$params[$arguments[$i]] = $param;
					++$i;
				}
			}
		}
		$params['command'] = $cmd;

		$input = new ArrayInput($params);
		$command->run($input, new Output());
	}

	private function checkUser() {
		if (!in_array(@$_SERVER['REMOTE_ADDR'], Config::get('web-artisan::ips')))
		{
			throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
		}
		else
		{		
			$password = Config::get('web-artisan::password');

			if ($password == $this->password)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
}