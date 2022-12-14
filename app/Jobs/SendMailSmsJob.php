<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\InforuSMSService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendMailSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private User $user)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param InforuSMSService $smsService
     * @return void
     */
    public function handle(InforuSMSService $smsService): void
    {
        try {
            if (config('external-apis.inforu.service_enabled')) {
                $smsService->sendMessage($this->user->phoneBook->phone_number, 'Thank you for registering!');
            }
            $this->user->sendRegistrationMail();
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
