<form method="post" action="" class="<?php esc_attr( $class ); ?>">

	<input  type="hidden"
			name="<?php echo esc_attr( $nonce ); ?>"
			value="<?php echo esc_attr( $nonce_value ); ?>" />

	<input  type="submit"
			name="<?php echo esc_attr( $action ); ?>"
			value="<?php echo esc_attr( $label ); ?>" />

</form>
