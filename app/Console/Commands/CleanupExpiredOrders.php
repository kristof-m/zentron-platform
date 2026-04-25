<?php

namespace App\Console\Commands;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:cleanup-expired-orders')]
#[Description('Clean up incomplete orders from expired guest sessions.')]
class CleanupExpiredOrders extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $lifetime = config('session.lifetime');
        $cutoff = now()->subMinutes($lifetime);

        $deleted = Order::whereNull('user_id')
            ->whereIn('status', [OrderStatus::InCart, OrderStatus::Confirmed])
            ->where('updated_at', '<', $cutoff)
            ->delete();

        $this->info("Cleaned up {$deleted} expired orders older than {$lifetime} minutes.");

        return 0;
    }
}
