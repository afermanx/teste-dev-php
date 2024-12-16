<?php
namespace App\Observers;

use App\Models\Supplier;
use Illuminate\Support\Facades\Cache;

class SupplierObserver
{
    /**
     * Handle the Supplier "created" event.
     */
    public function created(Supplier $supplier)
    {
        Cache::flush();
    }

    /**
     * Handle the Supplier "updated" event.
     */
    public function updated(Supplier $supplier)
    {
        Cache::flush();
    }

    /**
     * Handle the Supplier "deleted" event.
     */
    public function deleted(Supplier $supplier)
    {
        Cache::flush();
    }

    /**
     * Handle the Supplier "restored" event.
     */
    public function restored(Supplier $supplier)
    {
        Cache::flush();
    }
}
