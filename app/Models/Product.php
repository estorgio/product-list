<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'price', 'quantity', 'barcode', 'image', 'user_id'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('barcode', '=', $filters['search']);
        }
    }

    public function scopeSort($query, array $sort)
    {
        $field = $sort['field'] ?? 'created_at';
        $order = $sort['order'] ?? 'desc';

        $query->orderBy($field, $order);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
