<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ActiveUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $users_id;


    public function __construct($users_id)
    {
        $this->users_id = $users_id;
    }
    public function handle()
    {
        $user = $this->users_id;

        foreach($user as $ids){
            User::where('id', $ids)->update([
                'status'=>0
            ]);
        }
    }
}
