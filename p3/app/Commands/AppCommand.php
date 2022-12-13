<?php

namespace App\Commands;

use Faker\Factory;

class AppCommand extends Command
{
    public function fresh()
    {
        $this->migrate();
        $this->seed();
    }
    public function migrate()
    {
        $this->app->db()->createTable('rounds', [
            'choices'   => 'text',
            'winner'    => 'char(1)',
            'timestamp' => 'timestamp'
        ]);
        dump('Migrations complete');
    }

    public function seed()
    {
        $faker = Factory::create();
        $players = ['C', 'H', 'D'];

        for ($i = 10; $i > 0; $i--) {
            $this->app->db()->insert('rounds', [
                'choices'   => json_encode([]),
                'winner'    => $players[rand(0, 2)],
                'timestamp' => $faker->dateTimeBetween('-' . $i . ' days', '-' . $i . ' days')->format('Y-m-d H:i:s')
            ]);
        }
        dump('Seeds complete');
    }
}
