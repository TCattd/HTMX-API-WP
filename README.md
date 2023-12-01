# HTMX API for WordPress

An un-official WordPress plugin that adds [HTMX](https://htmx.org) to your WordPress site.

It enables a new endpoint `/wp-htmx/v1/` from where you can load any HTMX template.

## Why?

Because HTMX is awesome and WordPress is awesome. So, why not?

I'm using this in production in a few projects and it's working great, stable and ready to use. So I decided to share it with the world.

## How to use

After installation, you can use HTMX templates in your theme. Any theme.

Create a `templates-htmx` folder in your theme's root directory. This plugin has a demo folder that you can copy to your theme. Don't put your templates inside the demo folder located in the plugin's directory, because it will be deleted when you update the plugin.

Inside your `templates-htmx`, create as many templates as you want. All files must end with `.htmx.php`.

For example:

```
templates-htmx/live-search.htmx.php
templates-htmx/related-posts.htmx.php
templates-htmx/private/author.htmx.php
templates-htmx/private/author-posts.htmx.php
```

Check the demo template at `templates-htmx/demo.htmx.php` to see how to use it.


Then, in your theme, use HTMX to GET/POST to endpoint corresponding to the template you want to load:

```
/wp-htmx/v1/live-search
/wp-htmx/v1/related-posts
/wp-htmx/v1/private/author
/wp-htmx/v1/private/author-posts
```

### How to pass data to the template

You can pass data to the template using URL parameters (GET/POST). For example:

```
/wp-htmx/v1/live-search?search=hello
/wp-htmx/v1/related-posts?category_id=5
```

All of those parameters will be available inside the template as an array named: `$params`

### HTMX extensions and Hyperscrypt

This plugin comes with [Hyperscript](https://hyperscript.org) pre-loaded.

But you can enable any HTMX extension, in the plugin's options page: Settings > HTMX Options.

You can also enable [Hyperscript](https://hyperscript.org) in the same options page.

## Security

Every POST call to the endpoint, calling for any template, will automatically check for the nonce. If the nonce is not valid, the call will be rejected.

The nonce itself is auto-generated and added to all HTMX requests automatically.

## Suggestions, Support

Please, open [a discussion](https://github.com/TCattd/HTMX-API-WP/discussions).

## Bugs and Error reporting

Please, open [an issue](https://github.com/TCattd/HTMX-API-WP/issues).

## Changelog

[Available here](https://github.com/TCattd/HTMX-API-WP/blob/master/CHANGELOG.md).
