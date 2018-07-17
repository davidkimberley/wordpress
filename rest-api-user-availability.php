// USERNAME CHECK
add_action( 'rest_api_init', function(){
	register_rest_route( 'user_taken', '/available', [
		'args' => [
			'username' => [
				'type' => 'string',
				'required' => true,
			]
		],
		'callback' => function( $request ){
			if( is_wp_error(  username_exists( $request[ 'username' ] ) ) ){
				return rest_ensure_response( ['available' => 'error'] );
			}

			if(   username_exists( $request[ 'username' ] ) ){
				return rest_ensure_response( ['available' => true ] );
            } else {
            
			
			return rest_ensure_response( [ 'available' => false ] );
}

		}
	]);
});