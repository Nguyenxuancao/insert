// Redirect login to view website content.
add_action( 'template_redirect', 'login_template_redirect' );
function login_template_redirect() {
	$redirect_url = null;

	if( !is_user_logged_in() ) {
		$redirect_url = wp_login_url();
	}

	if( !empty( $redirect_url ) ) {
		wp_redirect( $redirect_url );
		die;
	}
}

// Redirect non-logged in users to a specific page.
add_action( 'template_redirect', 'login_template_redirect' );
function login_template_redirect() {
	$redirect_url = null;

	if( !is_page('about-us') && ! is_user_logged_in() ) {
		$redirect_url = wp_redirect( 'http://acao.com/about-us/' ); 
		exit;
	}
}
