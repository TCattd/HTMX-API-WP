<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}
?>
<h3>Hello HTMX!</h3>

<p>Demo template loaded from <code>plugins/htmx-api-wp/templates-htmx/demo.php</code></p>

<p>Received params:</p>

<pre>
<?php var_dump($params); ?>
</pre>
