<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * HTMX API URL
 * Returns the HTMX API URL, with a template path if provided
 *
 * @since 2023-12-04
 *
 * @param string $template_path (optional)
 *
 * @return string
 */
function hxwp_api_url($template_path = '')
{
	$htmx_api_url = home_url(HXWP_ENDPOINT . '/' . HXWP_ENDPOINT_VERSION);

	// Path provided?
	if (!empty($template_path)) {
		$htmx_api_url .= '/' . ltrim($template_path, '/');
	}

	return apply_filters('hxwp/api_url', $htmx_api_url);
}

/**
 * HTMX send header response and die()
 * To be used inside noswap templates
 * Sends HX-Trigger header with our response inside hxwpResponse
 *
 * @since 2023-12-13
 *
 * @param string $status (success|error|silent-sucess)
 * @param array $data (extra data, optional)
 * @param array $action (WP action, optional, default value: none)
 *
 * @return void
 */
function hxwp_send_header_response($status = 'success', $data = [], $action = null)
{
	if ($action === null) {
		// Check if action is set inside $_POST['hxvals']['action']
		$action = isset($_POST['hxvals']['action']) ? sanitize_text_field($_POST['hxvals']['action']) : '';
	}

	// Action still empty, null or not set?
	if (empty($action)) {
		$action = 'none';
	}

	// If success or silent-sucess, set code to 200
	$code = $status == 'error' ? 400 : 200;

	// Response array
	$response = [
		'hxwpResponse' => [
			'action'  => $action,
			'status'  => $status,
			'data'    => $data,
		],
	];

	// Headers already sent?
	if (headers_sent()) {
		wp_die('HWXP Error: Headers already sent.');
	}

	// Filter our response
	$response = apply_filters('hxwp/header_response', $response, $action, $status, $data);

	// Send our response
	status_header($code);
	nocache_headers();
	header('HX-Trigger: ' . json_encode($response));

	die(); // Don't need wp_die() here
}

/**
 * HTMX die helper
 * To be used inside templates
 * die, but with a 200 status code, so HTMX can show and display the error message
 * Also sends a custom header with the error message, to be used by HTMX if needed
 *
 * @since 2023-12-15
 *
 * @param string $message
 *
 * @return void
 */
function hxwp_die($message = '', $display_error = false)
{
	// Send our response
	if (!headers_sent()) {
		status_header(200);
		nocache_headers();
		header('HX-Error: ' . json_encode([
			'status'  => 'error',
			'data'    => [
				'message' => $message,
			],
		]));
	}

	// Don't display error message
	if ($display_error === false) {
		$message = '';
	}

	die($message);
}
