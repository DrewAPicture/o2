<?php

class o2_Offline {
	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'o2_options', array( $this, 'get_options' ) );
		add_action( 'wp_footer', array( $this, 'wp_footer' ) );
	}

	function enqueue_scripts() {
		wp_enqueue_script( 'o2-offline', plugins_url( 'o2/modules/offline/js/offline.js' ), array( 'jquery' ) );
	}

	function get_options( $options ) {
		$localizations = array(
			'connectionLostPrompt' => __( 'The connection to the server has been interrupted. Please reconnect.' )
		);
		$localizations = array_merge( $options['strings'], $localizations );
		$options['strings'] = $localizations;

		return $options;
	}

	function wp_footer() {
?>
		<script type="text/javascript">
			o2.Offline.init();
		</script>
<?php
	}
}

$o2_offline = new o2_Offline();
