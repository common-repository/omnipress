<style>
	#omnipress-consent-notice {
		border: none;
		padding-top: 10px;
	}

	#omnipress-consent-notice .consent-header {
		padding: 5px 0;
		background: #a8bc17;
		width: 100%;
	}

	#omnipress-consent-notice .consent-header h2 {
		color: #ffffff;
		font-size: 23px;
		padding-left: 5px;
	}

	#omnipress-consent-notice form .button-primary {
		background: #175fff;
		border: #175fff;
	}

	#omnipress-consent-notice .consent-footer {
		margin: 10px 0;
	}

	#omnipress-consent-notice details {
		cursor: pointer;
	}
</style>
<div id="omnipress-consent-notice" class="notice">
	<div class="consent-header">
		<h2><?php esc_html_e( '👋 Welcome to Omnipress! Count me in for important updates.', 'omnipress' ); ?></h2>
	</div>

	<div class="consent-body">
		<p><?php esc_html_e( 'Stay informed about important security updates, new features, exclusive deals, and allow non sensitive diagnostic tracking.', 'omnipress' ); ?></p>

		<form method="post">
			<button class="button button-primary" type="submit"><?php esc_html_e( 'Allow and Continue', 'omnipress' ); ?></button>
			<?php wp_nonce_field( 'omnipress_consent_optin', 'omnipress_consent_optin' ); ?>
		</form>
	</div>

	<div class="consent-footer">
		<details>
			<summary><?php esc_html_e( 'Learn more', 'omnipress' ); ?></summary>
			<h4><?php esc_html_e( 'You are granting these permissions.', 'omnipress' ); ?></h4>
			<ul>
				<li><?php esc_html_e( 'Your Profile Information', 'omnipress' ); ?></li>
				<li><?php esc_html_e( 'Your site Information ( URL, WP Version, PHP info, Plugins & Themes )', 'omnipress' ); ?></li>
				<li><?php esc_html_e( 'Plugin notices ( updates, announcements, marketing, no spam )', 'omnipress' ); ?></li>
				<li><?php esc_html_e( 'Plugin events ( activation, deactivation, and uninstall )', 'omnipress' ); ?></li>
			</ul>

			<form method="post">
				<button class="button button-link" type="submit"><?php esc_html_e( 'Skip Now', 'omnipress' ); ?></button>
				<?php wp_nonce_field( 'omnipress_consent_skip', 'omnipress_consent_skip' ); ?>
			</form>
		</details>
	</div>
</div>
