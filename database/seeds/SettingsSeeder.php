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
    		['id' => 1, 'terms' => $text, 'privacity' => $text, 'stripe_public' => 'pk_test_51K6kOMF1nDrlZowxv9Jw54ON3rnaowbUDqnuFzpN1tzhtoXCoxotte68mKC27dePm9rt2qx8BuK2a3CqrwQzubb0002k6iVTLR', 'stripe_secret' => 'sk_test_51K6kOMF1nDrlZowx2KkvhZA96arzFYrMA2ksAzdyGrXQhJnY4hXgCLVr0LnjQ8JLs3aqqLuSNNMLU8s1Ov7h7iTm003OdjR3ak', 'currency_id' => 1]
    	];
    	DB::table('settings')->insert($settings);
    }
}
