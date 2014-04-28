<?php

//Message Bag
use Illuminate\Support\MessageBag;

class AuthController extends BaseController {

	protected $adauth;

	protected $username;

	protected $password;

	protected $user;

	protected $staffClasses;

	protected $realsmartLogin;

	public function __construct(Services\Auth\Ldap\adLDAP $adauth, User $user, Services\Auth\Session\StaffClasses $staffClasses, Services\Auth\Realsmart\RealsmartLogin $realsmartLogin)
	{
		$this->adauth = $adauth;
		$this->user = $user;
		$this->beforeFilter('csrf', ["only" => ["postLogin"]]);
		$this->username = Input::get('username');
		$this->password = Input::get('password');
		$this->staffClasses = $staffClasses;
		$this->realsmartLogin = $realsmartLogin;
	}

	public function getIndex()
	{
		return View::make('auth.login');
	}

	public function postLogin()
	{

		try 
		{
			$adldap = new $this->adauth;
		}
		catch (adLDAPException $e)
		{
			return Redirect::to('/')->with('error', 'Incorrect adLDAP setup details, please contact an administrator.');
		}	


		$valid = $adldap->authenticate($this->username, $this->password);
		if ($valid)
		{
			//Retrieve details from ad. email, staff group, first name, username, surname
			$userinfo = $adldap->user()->info($this->username, ["mail", "description", "sn", "cn", "givenname"]);

			try
			{
				$user = $this->user->where('username', '=', $this->username)->first();
				if($user)
				{	
					Auth::login($user, true);
					//Set additional session data
					$this->staffClasses->addUpn(Auth::user()->upn);
					$this->staffClasses->requestDetails();
					$this->staffClasses->addToSession('classes');

					//Realsmart google login
					$realLink = $this->realsmartLogin->login(Auth::user()->upn);
					Session::put('realsmart', $realLink);

					return Redirect::to('/reports#/')->with('success', 'Successfully logged in.');
				} else {
					throw new Exception ("Failed");
				}
			} catch (Exception $e)
			{
				return Redirect::to('/')->with('error', 'You were logged into the council system but not the Walbottle system, please contact E-Learning on:
												<ul>
													<li>Email: <a href="mailto:elearning@walbottlecampus.newcastle.sch.uk">elearning@walbottlecampus.newcastle.sch.uk</a></li>
													<li>Ext: 276, 108 or 185</li> 
												</ul>');
			}
		} else {
			return Redirect::to('/')->with('error', 'Incorrect AD details.');
		}

	}
	public function getLogout()
	{
		Session::flush();
		Auth::logout();
		return Redirect::to('/')->with('success', 'Logged Out');
	}
	public function getDetails()
	{
		return Response::json(Auth::user());
	}

}