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

    public function generateStatusBadge()
    {
        $status = $this->ad_status;

        return match ($status) {
            AdStatus::PUBLISHED => '<span class="badge bg-green-500">Published</span>',
            AdStatus::DRAFT => '<span class="badge bg-yellow-500">Draft</span>',
            AdStatus::ARCHIVED => '<span class="badge bg-red-500">Archived</span>',
            default => '<span class="badge">Unknown</span>',
        };
    }

    public function generateFormatBadge()
    {
        $format = $this->ad_format;

        return match ($format) {
            AdFormat::AUTO => '<span class="badge">Auto</span>',
            AdFormat::RECTANGLE => '<span class="badge">Rectangle</span>',
            AdFormat::BANNER => '<span class="badge">Banner</span>',
            AdFormat::VERTICAL => '<span class="badge">Vertical</span>',
            default => '<span class="badge">Unknown</span>',
        };
    }

    public function generateResponsiveBadge()
    {
        return $this->ad_responsive
            ? '<span class="badge bg-yellow-500">Responsive</span>'
            : '<span class="badge bg-red-500">Non-Responsive</span>';
    }

    public function generateAdSenseCode()
    {
        $adBaseEndpoint = config('services.google.adsense.base_endpoint');

        $adSenseCode = <<<EOT
            <script async src="$adBaseEndpoint"></script>
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="{$this->ad_client}"
                data-ad-slot="{$this->ad_slot}"
                data-ad-format="{$this->ad_format->value}"
                data-full-width-responsive="{$this->ad_responsive}"></ins>
            <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        EOT;

        return $adSenseCode;
    }
}
