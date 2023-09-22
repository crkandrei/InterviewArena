<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokensPackage extends Model
{
    use HasFactory;

    public function userTokenPurchases() {
        return $this->hasMany(UserTokenPurchase::class);
    }

}
