<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'sangh_id',
        'center_id',
        'event_year',
        'has_other_sangh',
        'jain_family_count',
        'member_count',
        'willing_to_celebrate',
        'contact_person',
        'pravachan_language',
        'pratikraman_proficient',
        'pratikraman_present',
        'pratikraman_how_many',
        'bhakti_musicians',
        'bhakti_group',
        'bhakti_instruments',
        'bhakti_instrument_list',
        'has_upashray',
        'is_permanent_upashray',
        'is_temporary_upashray',
        'is_rented_upashray',
        'is_rented_hall',
        'is_rented_house',
        'is_rented_shop',
        'is_rented_farmhouse',
        'is_rented_bungalow',
        'attendance',
        'mahatma_sadhu',
        'mahatma_sadhviji',
        'mahatma_chaturmas',
        'status',
        'terms_agree'
    ];

    protected $casts = [
        'has_other_sangh' => 'boolean',
        'jain_family_count' => 'integer',
        'member_count' => 'integer',
        'willing_to_celebrate' => 'boolean',
        'contact_person' => 'array',
        'pratikraman_proficient' => 'boolean',
        'pratikraman_present' => 'boolean',
        'pratikraman_how_many' => 'integer',
        'bhakti_musicians' => 'boolean',
        'bhakti_group' => 'boolean',
        'bhakti_instruments' => 'boolean',
        'has_upashray' => 'boolean',
        'is_permanent_upashray' => 'boolean',
        'is_temporary_upashray' => 'boolean',
        'is_rented_upashray' => 'boolean',
        'is_rented_hall' => 'boolean',
        'is_rented_house' => 'boolean',
        'is_rented_shop' => 'boolean',
        'is_rented_farmhouse' => 'boolean',
        'is_rented_bungalow' => 'boolean',
        'attendance' => 'array',
        'mahatma_sadhu' => 'boolean',
        'mahatma_sadhviji' => 'boolean',
        'mahatma_chaturmas' => 'boolean',
    ];

    public function sangh()
    {
        return $this->belongsTo(Sangh::class);
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function getPdfDocumentUrl()
    {
        $media = $this->getFirstMedia('event_pdf_document');
        return $media ? $media->getUrl() : null;
    }

    public function hasPdfDocument()
    {
        return $this->hasMedia('event_pdf_document');
    }

    public function centerAssignments()
    {
        return $this->hasMany(\App\Models\EventCenterAssignment::class);
    }
} 