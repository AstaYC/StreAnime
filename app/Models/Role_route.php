<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_route extends Model
{
    use HasFactory;
    protected $fillable = [
        'role_id',
        'route_id',
    ];
    
    public $timestamps = false;
    protected $table = 'role_route';

    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * The route that the permission belongs to.
     */
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
    
}
