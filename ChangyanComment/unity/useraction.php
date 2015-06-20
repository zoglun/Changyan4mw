<?php
class useraction extends SpecialPage{
    public function login($user){
        global $wgSecureLogin,$wgCookieSecure,$wgMemc;

		$this->loginForm = new LoginForm;
		$loginForm = $this->loginForm;
		$loginForm->load();
		$user->load();

		if ( $user->requiresHTTPS() ) {
			$loginForm->mStickHTTPS = true;
		}

		if ( $wgSecureLogin && !$this->mStickHTTPS ) {
			$user->setCookies( null, false );
		} else {
			$user->setCookies();
		}

		// Reset the throttle
		$request = $this->getRequest();
		$key = wfMemcKey( 'password-throttle', $request->getIP(), md5( $user->mName ) );
		$wgMemc->delete( $key );

		/* Replace the language object to provide user interface in
		 * correct language immediately on this first page load.
		 */
		$code = $request->getVal( 'uselang', $user->getOption( 'language' ) );
		$userLang = Language::factory( $code );
		$wgLang = $userLang;
		$this->getContext()->setLanguage( $userLang );

		// $this->renewSessionId();
		if ( $wgSecureLogin && !$this->mStickHTTPS ) {
			$wgCookieSecure = false;
		}
		session_start();
		wfResetSessionID();
		
		$injected_html = '';
		wfRunHooks( 'UserLogoutComplete', array( &$user, &$injected_html, $oldName ) );

    }
    public function logout(){
    	$user = $this->getUser();
		$oldName = $user->getName();
		$user->logout();

    }
}

$mwuser=new useraction();
?>