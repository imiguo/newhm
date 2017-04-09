<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hyip:admin {email} {name=admin} {password=admin8866}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a admin user';

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
        $email = $this->argument('email');
        $name = $this->argument('name');
        $password = $this->argument('password');
        $user = User::where('email', $email)->orWhere('name', $name)->first();
        if ($user) {
            if ($user->is_admin) {
                $user->name = $name;
                $user->password = bcrypt($password);
                $user->save();
                $this->info('reset admin success');
            } else {
                $this->error('already exist an investor with the email');
            }
        } else {
            User::create([
                'name' => $this->argument('name'),
                'email' => $this->argument('email'),
                'password' => bcrypt($this->argument('password')),
                'is_admin' => 1,
            ]);
            $this->info('create admin success');
        }

    }
}
