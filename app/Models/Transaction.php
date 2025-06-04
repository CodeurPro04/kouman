<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'reservation_id',
        'montant',
        'date_paiement',
        'mode_paiement',
        'statut'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
