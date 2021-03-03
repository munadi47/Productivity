<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
		'authFilter' => \App\Filters\AuthFilter::class,
		'filterAdmin' => \App\Filters\FilterAdmin::class,

	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			'authFilter' => ['except' => ['/','/login','/auth','auth/*','register/']],

			'filterAdmin' => ['except' => ['/','/login','/auth','auth/*','register/']],

			// 'honeypot',
			// 'csrf',
		],
		'after'  => [
			'toolbar',

			'authFilter' => ['except' => ['/Client','/Client/*','/Product','/Product/*','/Salespipeline','/Salespipeline/*',
			'/Video','/Video/*',
			'/Digital','/Digital/*',
			'/Learning','/Learning/*',
			'/Consulting','/Consulting/*',
			'/Employee/edit/*','/Employee/editProfile/*',
			'/Attendance','/Attendance/*',

			]],

			'filterAdmin' => ['except' => ['/Client','/Client/*','/Product','/Product/*','/Salespipeline','/Salespipeline/*',
			'/Video','/Video/*',
			'/Digital','/Digital/*',
			'/Learning','/Learning/*',
			'/Consulting','/Consulting/*',
			'/Employee','/Employee/*',
			'/Company','/Company/*',
			'/Finance','/Finance/*',
			'/Activity','/Activity/*',
			'/Dashboard','/Dashboard/*',
			'/Attendance','/Attendance/*',
			]],

			/*'filterAdmin' => ['except' => ['/Client','/Client/*','/Employee','/Employee/*','/Company','/Company/*','/Product','/Product/*','/Salespipeline','/Salespipeline/*',
			'/Video','/Video/*',
			'/Digital','/Digital/*',
			'/Learning','/Learning/*',
			'/Consulting','/Consulting/*',
			'/Finance','/Finance/*',
			'/Activity','/Activity/*',
			]],*/
			// 'honeypot',
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [];
}
