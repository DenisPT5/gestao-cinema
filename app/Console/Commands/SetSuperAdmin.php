<?php
namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SetSuperAdmin extends Command
{
    protected $signature = 'set:superadmin {email}';
    protected $description = 'Define um utilizador como superadmin';

    public function handle()
    {
        $user = User::where('email', $this->argument('email'))->first();
        if (!$user) {
            $this->error('Utilizador não encontrado!');
            return;
        }
        $user->update(['role' => 'superadmin']);
        $this->info('Utilizador ' . $user->name . ' definido como superadmin!');
    }
}