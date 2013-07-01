<?php

namespace Jones\WebArtisan\Controllers;

use Illuminate\Support\Facades\Config,
    Illuminate\Support\Facades\Artisan,
    Illuminate\Support\Facades\Input,
    Illuminate\Support\Facades\Session,
    Illuminate\Support\Facades\Request,
    Illuminate\Support\Facades\View,
    Illuminate\Console\Application,
    Illuminate\Foundation\ProviderRepository,
    Illuminate\Filesystem\Filesystem,
    \Jones\WebArtisan\Cli\Output;

class Cmd extends \BaseController {

        private $stdfile = null;
        private $password = null;

        /**
         * .
         *
         * @return void
         */
        public function __construct() {
                if (!Config::get('web-artisan::enable')) {
                        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
                }
                if (Session::has('password')) {
                        $this->password = Session::get('password');
                }
        }

        public function index() {
                return View::make('web-artisan::webartisan');
        }

        public function password() {
                $this->password = trim(Input::get('password'));
                Session::put('password', $this->password);
                if ($this->checkUser()) {
                        echo 'You are loged in now';
                        return;
                }
                echo 'Password is not correct';
        }

        public function run() {
                if ($this->checkUser()) {
					$parts = explode(" ", Input::get('cmd'));
					
					//first is "artisan" so remove it
					unset($parts[0]);
					
					//second is the command
					$cmd = $parts[1];
					unset($parts[1]);
					
					$params = array();
					//the rest should be the parameter list
					foreach($parts as $param) {
						// foo=bar
						if(strpos($param, "=") !== false)
						{
							$param = explode("=", $param, 2);
							$params[$param[0]] = $param[1];
						}
						else
						{
							$params[] = $param;
						}
					}
					
					Artisan::call($cmd, $params, new Output());
                }
                else
                    echo "Please login with Password";
        }

        private function checkUser() {
                if (!in_array(@$_SERVER['REMOTE_ADDR'], Config::get('web-artisan::ips'))) {
                        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
                } else {

                        $c_key = Config::get('web-artisan::password');

                        if ($c_key == $this->password) {
                                return TRUE;
                        } else {
                                return FALSE;
                        }
                }
        }
}