<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Stats;
use App\Models\Type;
use App\Repositories\Contract\StatContract;
use App\Repositories\Contract\TypeContract;

final class StatRepository extends BaseRepository implements StatContract
{
    public function __construct(
        protected Stats $stat
    )
    {
        parent::__construct($this->stat);
    }
}
