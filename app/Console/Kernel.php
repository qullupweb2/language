<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Contract;
use App\Http\Services\ClientService;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

		$schedule->call(function (ClientService $clientService) {
			$contracts = Contract::select('contracts.*', 'users.email', 'users.phone')
				->leftJoin('users', 'users.id', '=', 'contracts.user_id')
				->where('contracts.created_at', '<=', 'DATE_SUB(NOW(), INTERVAL 10 DAY)')
				->where('send_reminder', 1)
				->get();

			foreach ($contracts as $contract) {
				Mail::raw(__('sms_messages.course_reminder'), function ($message) use ($contract) {
					$message->to($contract->email)
						->subject('Reminder course');
				});

				$clientService->sendSms($contract->phone, __('sms_messages.course_reminder'));
			}

		})->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
