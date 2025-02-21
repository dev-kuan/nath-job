<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\JobQualification;
use App\Models\JobResponsibility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyJob extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 
        'slug', 
        'type', 
        'location', 
        'skill_level', 
        'salary', 
        'thumbnail', 
        'about', 
        'is_open', 
        'company_id',
        'category_id'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function responsibilities() {
        return $this->hasMany(JobResponsibility::class);
    }

    public function qualifications() {
        return $this->hasMany(JobQualification::class);
    }

    public function candidates() {
        return $this->hasMany(JobCandidate::class);
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false,
            fn($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%')
                ->orWhere('skill_level', 'like', '%' . $search . '%')
        );
    }

    public function scopeSortBy($query, $sortBy) {
        switch ($sortBy) {
            case 'latest':
                return $query->orderBy('created_at', 'desc');
            case 'oldest':
                return $query->orderBy('created_at', 'asc');
            case 'highest_salary':
                return $query->orderBy('salary', 'desc');
            case 'lowest_salary':
                return $query->orderBy('salary', 'asc');
            case 'name_asc':
                return $query->orderBy('name', 'asc');
            case 'name_desc':
                return $query->orderBy('name', 'desc');
            default:
                return $query->orderBy('created_at', 'desc');
        }
    }
}
