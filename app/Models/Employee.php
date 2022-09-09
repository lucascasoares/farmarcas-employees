<?php

namespace App\Models;

use App\Models\Concerns\Fillable;
use App\Models\Concerns\Filterable;
use App\Models\Concerns\Orderable;
use App\Models\Concerns\Searchable;
use App\Models\Relations\HasManyWages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use Fillable;
    use Filterable;
    use HasFactory;
    use HasManyWages;
    use Orderable;
    use Searchable;
}
