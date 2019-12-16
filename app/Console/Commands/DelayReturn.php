<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
class DelayReturn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email to return back products';

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
        //add mail testing
        $to_name = 'Bulanzrs 2020';
        $to_email = 'bulanzrs2020@gmail.com';
        $data = array('name'=>"Ogbonna Vitalis(sender_name)", "body" => "A test mail");
        \Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Laravel Test Mail');
            $message->from('mintomia199@gmail.com','Test Mail');
        });
        //end mail testing
    }
}
