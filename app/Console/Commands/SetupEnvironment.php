<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class SetupEnvironment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the startup environment';

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
        $this->info('Setting up environment');
        $this->migrateAndSeedDatabase();
        $user = $this->createFirstUser();
        $this->info('All done. Bye!');
    }

    /**
     *  Migrate and Seed the Database
     *
     * @return null
     */
    public function migrateAndSeedDatabase()
    {
        $this->call('migrate:fresh');
        $this->call('db:seed');
    }

    /**
     *  Create the First User
     *
     * @return null
     */
    public function createFirstUser()
    {
        $this->info('Creating First user');
        $user = factory(User::class)->create(
            [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('secret'),
            ]
        );
        $this->info('Test User created');
        $this->warn('Email: test@example.com');
        $this->warn('Password: secret');
        return $user;
    }
}
