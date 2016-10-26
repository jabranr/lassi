<?php

namespace Lassi\App;

/**
 * Util
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */

use Lassi\App\Exception\NotFoundException;
use Lassi\App\Exception\UnreadableException;

class Util {

	/**
	 * Set app environment variables
	 *
	 * @param string $root
	 * @return void
	 */
	public static function setEnvVariables($root = '/') {
		$configs = null;

		// Set custom handler to catch errors as exceptions
		set_error_handler(
		    create_function(
		        '$severity, $message, $file, $line',
		        'throw new \ErrorException($message, $severity, $severity, $file, $line);'
		    )
		);

		if ( file_exists($root . '/.dev.env') && is_readable($root . '/.dev.env') ) {
			$configs = file_get_contents($root . '/.dev.env');
		}
		else if ( file_exists($root . '/.dist.env') && is_readable($root . '/.dist.env') ) {
			$configs = file_get_contents($root . '/.dist.env');
		}
		else if ( file_exists($root . '/.test.env') && is_readable($root . '/.test.env') ) {
			$configs = file_get_contents($root . '/.test.env');
		}
		else if ( file_exists($root . '/.env') && is_readable($root . '/.env') ) {
			$configs = file_get_contents($root . '/.env');
		}
		else {
			throw new NotFoundException('No configuration file found.');
		}

		if (false === $configs || null !== error_get_last()) {
			throw new UnreadableException('Configuration not readable.');
		}

		// Restore original error handler
		restore_error_handler();

		$configs = explode("\n", trim($configs));
		array_map(function($config) {

			// Remove whitespaces
			$config = preg_replace('(\s+)', '', $config);

			// Add as environment variables
			putenv($config);
		}, $configs);
	}
}
