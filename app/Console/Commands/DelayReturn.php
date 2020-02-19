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

       //add logic for email
       $today = date("Y-m-d");
       $get_return = DB::table('orders')
                     ->where('expire_date','<',$today)
                     ->where('status_order','=',1)
                     ->get();

        if($get_return!=null){
          foreach ($get_return as $get) {
            //get the email from user table
            $get_email = DB::table('users')->where('id','=',$get->buyer_id)->first();
            //add mail testing
            $to_name =$get_email->name;
            $to_email =$get_email->email;
            $data = array('name'=>$get_email->name, "body" =>$get->expire_date);
            \Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('Product Return Reminder');
                $message->from('sm11935p@gmail.com','Product Reminder From Let-Share');
            });
            //end mail testing
          }//foreach

        }//if


    }
}
