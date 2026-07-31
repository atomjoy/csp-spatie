<?php

namespace App\Support\Csp\Traits;

use Spatie\Csp\Directive;

trait HasStripe
{
	protected function configureStripe(): void
	{
		$this
			->add(Directive::SCRIPT, [
				'https://stripe.com',
				'https://*.stripe.network',
			])
			->add(Directive::CONNECT, [
				'https://stripe.com',
				'https://*.stripe.network',
			])
			->add(Directive::IMG, [
				'https://*.stripe.com',
			])
			->add(Directive::FRAME, [
				'https://stripe.com',
				'https://stripe.com',
			]);
	}
}
