<?php

namespace App\Support\Csp\Traits;

use Spatie\Csp\Directive;

trait HasGoogleAnalyticsAndGtm
{
	protected function configureGoogleAnalyticsAndGtm(): void
	{
		$this
			->add(Directive::SCRIPT, [
				'https://googletagmanager.com',
				'https://*.google-analytics.com',
			])
			->add(Directive::CONNECT, [
				'https://*.google-analytics.com',
				'https://*.analytics.google.com',
				'https://*.googletagmanager.com',
			])
			->add(Directive::IMG, [
				'https://*.google-analytics.com',
				'https://*.googletagmanager.com',
			]);
	}
}
