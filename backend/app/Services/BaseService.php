<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

/**
 * BaseService - Abstract base class for all services
 * 
 * All services should extend this class to ensure consistent patterns:
 * - Database transaction handling
 * - Exception handling
 * - Logging
 * - Error responses
 */
abstract class BaseService
{
    /**
     * Execute operation with transaction
     */
    public function transaction(callable $callback)
    {
        return \DB::transaction($callback);
    }

    /**
     * Handle service errors
     */
    protected function handleError(\Exception $e, $message = null)
    {
        \Log::error($message ?? $e->getMessage(), [
            'exception' => get_class($e),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ]);

        throw $e;
    }

    /**
     * Log operation
     */
    protected function log($message, $data = [])
    {
        \Log::info($message, $data);
    }
}
