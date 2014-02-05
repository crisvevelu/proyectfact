<?php

	class AuthController extends BaseController {
		protected $layout = "layouts.main";

		public function getLogin() {
			if (Auth::check()) {
				return Redirect::to('/');
			}
			return View::make('users/login');
		}

		public function postSignin() {
			if ( Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password'))) ) {

				$email = Input::get('email');
				if($user = User::where('email', '=', $email)->first() ) {
					Session::put('id', $user->id);
					Session::put('username', $user->username);
					Session::put('user_type', $user->tipo_user);

					return Redirect::to('users/dashboard')->with('message', '¡Estas dentro!');
				}
			} else {
				return Redirect::to('/login')
				->with('message', 'Tu email/contraseña es incorrecto')
				->withInput();
			}
		}

		public function getLogout() {
			Auth::logout();
			//Session::flush();
			return Redirect::to('/login')->with('message', '¡Tu sesión ha sido cerrada.!');
		}
	}
?>