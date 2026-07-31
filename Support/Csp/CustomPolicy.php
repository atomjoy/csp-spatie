<?php

namespace App\Support\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Policy;
use App\Support\Csp\Traits\HasStripe;
use App\Support\Csp\Traits\HasHotjar;
use App\Support\Csp\Traits\HasXPlatform;
use App\Support\Csp\Traits\HasDribbble;
use App\Support\Csp\Traits\HasPinterest;
use App\Support\Csp\Traits\HasGoogleMaps;
use App\Support\Csp\Traits\HasCloudflare;
use App\Support\Csp\Traits\HasGoogleFonts;
use App\Support\Csp\Traits\HasFacebookPixel;
use App\Support\Csp\Traits\HasGoogleAnalyticsAndGtm;

// Spatie Csp
// <script nonce="{{ csp_nonce() }}"> GTM </script>
// Add in config/csp.php
// 'policy' => App\Support\Csp\CustomPolicy::class,
// 'report_uri' => env('CSP_REPORT_URI', null),
class CustomPolicy extends Policy
{
	use HasFacebookPixel,
		HasGoogleAnalyticsAndGtm,
		HasGoogleMaps,
		HasGoogleFonts,
		HasStripe,
		HasXPlatform,
		HasHotjar,
		HasPinterest,
		HasDribbble,
		HasCloudflare;

	public function configure(): void
	{
		// 1. Podstawowa konfiguracja bezpieczeństwa aplikacji (Base Policy)
		$this
			->add(Directive::DEFAULT, 'self')
			->add(Directive::SCRIPT, 'self')
			->add(Directive::STYLE, ['self', 'unsafe-inline']) // Pozwól na style CSS (Inertia/Vite tego wymaga)
			->add(Directive::IMG, ['self', 'data:', 'blob:'])
			->add(Directive::FONT, ['self', 'data:'])
			->add(Directive::CONNECT, 'self')
			->add(Directive::FRAME, 'none')
			->add(Directive::OBJECT, 'none')
			->add('embed-src', 'none');

		// 2. Włączenie mechanizmu Nonce dla skryptów oraz stylów inline
		$this
			->addNonce(Directive::SCRIPT)
			->addNonce(Directive::STYLE);

		// 3. Dynamiczne ładowanie konfiguracji ze wszystkich Traitów
		$this->configureFacebookPixel();
		$this->configureGoogleAnalyticsAndGtm();
		$this->configureGoogleMaps();
		$this->configureGoogleFonts();
		$this->configureStripe();
		$this->configureXPlatform();
		$this->configureHotjar();
		$this->configurePinterest();
		$this->configureDribbble();
		$this->configureCloudflare();
	}
}
