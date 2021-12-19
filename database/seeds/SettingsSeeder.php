<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $text="<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>";
        $settings = [
    		['id' => 1, 'terms' => $text, 'privacity' => $text, 'stripe_public' => 'pk_test_51K6kOMF1nDrlZowxrw8mhkZrU3THtX2tN5deSEzgyL3CV1qN8dlKNulL5oeqUb3Socl3eMowG21euJAbN3A30sLB00a8k9ccpD', 'stripe_secret' => 'sk_test_51K6kOMF1nDrlZowxVrdCsveoCBJYHKMmdou0utST9mNai7MNoJNyBQkjWtjRHaQSyqAwzxHzbS7Qibsvrh7cBcyf00iuu96tgi', 'currency_id' => 1]
    	];
    	DB::table('settings')->insert($settings);
    }
}
