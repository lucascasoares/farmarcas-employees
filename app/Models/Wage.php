<?php

namespace App\Models;

use App\Models\Concerns\Fillable;
use App\Models\Concerns\Filterable;
use App\Models\Concerns\Orderable;
use App\Models\Concerns\Searchable;
use App\Models\Relations\BelongsToEmployee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wage extends Model
{
    use Fillable;
    use Filterable;
    use BelongsToEmployee;
    use HasFactory;
    use Orderable;
    use Searchable;
}
