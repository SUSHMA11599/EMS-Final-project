<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class user_type extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change_user_type';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Changes the type of User';

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
     * @return int
     */
    public function handle()
    {   
        $users = User::all();

        echo "Following is the list of users : \n\n";

        foreach( $users as $user){
            echo "UserName : ".$user['first_name']." ".$user['last_name'].
            "\t, emp_id : ".$user['emp_id']."\t"."User Type : ".$user['type_of_user']."\n";
            ;
        }

        print("\n\n");

        print("Press 1 to make a user Admin \n");
        print("Press 2 to make a user Manager \n");
        print("Press 3 to change a user to Normal user \n");
        print("Press 4 to quit\n");

        $input = (int)readline("Enter your response : ");

        if( $input == 1 )
        {
            $id   = readline("Enter id of the user to make them an Admin : ");
            try{
                $user = User::where('emp_id', $id)->update(array('type_of_user' => 'Admin'));
                if($user){
                    echo "User type changed successfully \n";
                }
                else{
                    echo"Input might not be valid, please check again \n";
                }
            }
            catch( Exception $e ){
                echo "Exception : ".$e->getMessage();
            }
        }
        elseif( $input == 2)
        {
            $id = readline("Enter id of the user to make them a Manager : ");
            try{
                $user = User::where('emp_id', $id)->update(array('type_of_user' => 'Manager'));
                if($user){
                    echo "User type changed successfully \n";
                }
                else{
                    echo"Input might not be valid, please check again \n";
                }
            }
            catch( Exception $e ){
                echo "Exception : ".$e->getMessage();
            }
        }
        elseif( $input == 3){
            $id = readline("Enter id of the user to make them a Normal User : ");
            try{
                $user = User::where('emp_id', $id)->update(array('type_of_user' => 'Normal'));
                if($user){
                    echo "User type changed successfully \n";
                }
                else{
                    echo"Input might not be valid, please check again \n";
                }
            }
            catch( Exception $e ){
                echo "Exception : ".$e->getMessage();
            }
        }
        elseif( $input == 4){
            exit("exiting...");
        }
        else
        {
            exit("Invalid Input, exiting...\n");
        }

        return 0;
    }


}
