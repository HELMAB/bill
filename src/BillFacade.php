<?php

namespace Asorasoft\Bill;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Asorasoft\Bill\Skeleton\SkeletonClass
 */
class BillFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bill';
    }
}
