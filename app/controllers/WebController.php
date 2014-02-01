<?php

	class WebController extends BaseController {
		public function action_index()	{
			if(!Auth::check()) {
				return Redirect::to('/login');
			} else {
				return Redirect::to('/users/dashboard');
			}
		}
	}