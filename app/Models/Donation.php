<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    protected $fillable = [
        'tracking_code', 
        'user_id',
        'donor_name',
        'donor_email',
        'tree_type_id',         
        'location',
        'location_detail',      
        'program',
        'quantity',
        'amount',
        'plant_date',           
        'latitude',             
        'longitude',            
        'health_status',        
        'growth_progress',      
        'status'                
    ];

    protected $casts = [
        'plant_date' => 'date',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'amount' => 'decimal:2',
        'growth_progress' => 'integer'
    ];

    // Relasi User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi 
    public function treeType(): BelongsTo
    {
        return $this->belongsTo(Pohon::class, 'tree_type_id');
    }
}