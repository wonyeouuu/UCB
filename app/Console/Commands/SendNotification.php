<?php

namespace App\Console\Commands;

use App\Alert;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Services\SendNotificationService;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $alerts = Alert::with('reminder.user')
            ->where('alert_at', '<=', Carbon::now())
            ->where('status', Alert::$ENUM_STATUS['PENDING'])
            ->get();
        $sendService = new SendNotificationService();
        $alerts->each(function ($alert) use ($sendService) {
            $result = $sendService
                ->setUser($alert->reminder->user)
                ->setAlert($alert)
                ->send();
            if ($result->success == 1) {
                $alert->status = Alert::$ENUM_STATUS['TRIGGERED'];
                $alert->save();
            }
        });
    }
}
