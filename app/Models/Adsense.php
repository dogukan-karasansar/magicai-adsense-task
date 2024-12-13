<?php

namespace App\Models;

use App\Enums\Adsense\AdFormat;
use App\Enums\Adsense\AdStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adsense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ad_client',
        'ad_slot',
        'ad_format',
        'ad_status',
        'ad_responsive',
    ];

    protected $casts = [
        'ad_responsive' => 'boolean',
        'ad_format' => AdFormat::class,
        'ad_status' => AdStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generateAdSenseCode()
    {
        $adFormat = AdFormat::from($this->ad_format);

        $adBaseEndpoint = config('services.google.adsense.base_endpoint');
        $adClient = $this->ad_client;
        $adSlot = $this->ad_slot;
        $adResponsive = $this->ad_responsive ? 'true' : 'false';
        

        $adSenseCode = <<<EOT
            <script async src="$adBaseEndpoint"></script>
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="$adClient"
                data-ad-slot="$adSlot"
                data-ad-format="$adFormat"
                data-full-width-responsive="$adResponsive"></ins>
            <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        EOT;

        return $adSenseCode;
    }
}
