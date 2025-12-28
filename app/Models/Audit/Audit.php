<?php

namespace App\Models\Audit;

use App\Models\book_of_real_estate_registration_folder\book_of_real_estate_people;
use App\Models\book_of_real_estate_registration_folder\book_of_real_estate_registration_comment;
use App\Models\book_of_real_estate_registration_folder\book_of_real_estate_registration_final_states;
use App\Models\book_of_real_estate_registration_folder\book_of_real_estate_registration_mortgage_rates;
use App\Models\book_of_real_estate_registration_folder\book_of_real_estate_registration_under_control;

use App\Models\LandDistribution\DistributionBookFile;
use App\Models\LandDistribution\DistributionBookPerson;
use App\Models\LandDistribution\DistributionBookVolume;
use App\Models\LandDistribution\DistributionDocumentFile;
use App\Models\LandDistribution\DistributionFileType;
use App\Models\LandDistribution\DistributionLandBook;
use App\Models\LandDistribution\DistributionProjectBook;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function distribution_land()
    {
        return $this->belongsTo(DistributionLandBook::class, 'property_id', 'id');
    }

    public function relatedModel()
    {
        return match ($this->auditable_type) {
            'book_of_real_estate_registration_comments' => $this->belongsTo(book_of_real_estate_registration_comment::class, 'auditable_id'),
            'book_of_real_estate_registration_final_states' => $this->belongsTo(book_of_real_estate_registration_final_states::class, 'auditable_id'),
            'book_of_real_estate_registration_mortgage_rates' => $this->belongsTo(book_of_real_estate_registration_mortgage_rates::class, 'auditable_id'),
            'App\Models\book_of_real_estate_registration_folder\book_of_real_estate_registration_under_control' => $this->belongsTo(book_of_real_estate_registration_under_control::class, 'auditable_id'),
            'App\Models\book_of_real_estate_registration_folder\book_of_real_estate_people' => $this->belongsTo(book_of_real_estate_people::class, 'auditable_id'),
            
            // Distribution Models
            'App\Models\LandDistribution\DistributionBookFile'      => $this->belongsTo(DistributionBookFile::class, 'auditable_id'),
            'App\Models\LandDistribution\DistributionLandBook'      => $this->belongsTo(DistributionLandBook::class, 'auditable_id'),
            'App\Models\LandDistribution\DistributionBookPerson'    => $this->belongsTo(DistributionBookPerson::class, 'auditable_id'),
            'App\Models\LandDistribution\DistributionProjectBook'   => $this->belongsTo(DistributionProjectBook::class, 'auditable_id'),
            'App\Models\LandDistribution\DistributionBookVolume'    => $this->belongsTo(DistributionBookVolume::class, 'auditable_id'),
            'App\Models\LandDistribution\DistributionDocumentFile'  => $this->belongsTo(DistributionDocumentFile::class, 'auditable_id'),
            'App\Models\LandDistribution\DistributionFileType'      => $this->belongsTo(DistributionFileType::class, 'auditable_id'),
            default => null,
        };
    }

}
