<?php

namespace App\Models\Concerns;

use Illuminate\Database\Query\Builder;

trait Orderable
{
    /**
     * Executes query ordering.
     *
     * @param Builder $query
     * @param array $order
     * @return Builder
     */
    public function scopeOrder($query, $order)
    {
        $orderBy = data_get($order, 'by');
        $orderDir = data_get($order, 'dir');

        if (! in_array($orderBy, $this->getOrderColumns())) {
            $orderBy = $this->getOrderKey();
        }

        if (! in_array($orderDir, ['asc', 'desc'])) {
            $orderDir = $this->getOrderDir();
        }

        if (strpos($orderBy, '--') !== false) {
            $field = implode('.', explode('--', $orderBy));
        } else if (substr($orderBy, -2) === '__') {
                $field = substr($orderBy, 0, -2);
        } else {
            $field = $this->getTable().'.'.$orderBy;
        }

        $query->orderBy($field, $orderDir);

        return $query;
    }

    /**
     * Get default order direction.
     *
     * @return string
     */
    public function getOrderDir()
    {
        return 'desc';
    }

    /**
     * Get default order key.
     *
     * @return string
     */
    public function getOrderKey()
    {
        return $this->getKeyName();
    }

    /**
     * Get available ordering columns.
     *
     * @return array
     */
    public function getOrderColumns()
    {
        return [
            $this->getOrderKey()
        ];
    }
}
