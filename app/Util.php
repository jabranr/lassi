<?php namespace Lassi\App;

/**
 * Util
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */

use Lassi\App\Exception\ResourceNotFoundException;
use Lassi\App\Exception\ResourceAccessException;

class Util {

	/**
	 * Set app env variables
	 * @return void
	 */
	public static function setupEnvironment($root = '/', $remove = false) {
		$configs = null;

		// Set custom handler to catch errors as exceptions
		set_error_handler(
		    create_function(
		        '$severity, $message, $file, $line',
		        'throw new ErrorException($message, $severity, $severity, $file, $line);'
		    )
		);

		if ( file_exists($root . '/.dev.env') && is_readable($root . '/.dev.env') ) {
			try {
				$configs = file_get_contents($root . '/.dev.env');
			} catch(ResourceAccessException $e) {
				die($e->getMessage());
			}
		}
		else if ( file_exists($root . '/.dist.env') && is_readable($root . '/.dist.env') ) {
			try {
				$configs = file_get_contents($root . '/.dist.env');
			} catch(ResourceAccessException $e) {
				die($e->getMessage());
			}
		}
		else if ( file_exists($root . '/.env') && is_readable($root . '/.env') ) {
			try {
				$configs = file_get_contents($root . '/.env');
			} catch(ResourceAccessException $e) {
				die($e->getMessage());
			}
		}
		else {
			throw new ResourceNotFoundException('No configuration found.');
		}

		// Restore original error handler
		restore_error_handler();

		$configs = explode("\n", trim($configs));
		array_map(function($config) use ($remove) {

			// Remove whitespaces
			$config = preg_replace('(\s+)', '', $config);

			// Add/remove as global vars
			if ( $remove ) {
				$tuple = explode('=', $config);
				putenv($tuple[0]);
			}
			else {
				putenv($config);
			}
		}, $configs);
	}
}
