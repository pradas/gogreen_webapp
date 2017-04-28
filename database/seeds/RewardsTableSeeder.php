<?php

use Illuminate\Database\Seeder;
use App\Reward;

class RewardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reward = new Reward;
        $reward->title = "Motos eCooltra";
        $reward->points = 125;
        $reward->category_id = 2;
        $reward->end_date = \Carbon\Carbon::createFromDate(2017, 12, 1);;
        $reward->exchange_date = \Carbon\Carbon::createFromDate(2018, 5, 21);;
        $reward->description = "Descubre BCN con una moto electrica";
        $reward->exchange_info = "Descarga la App";
        $reward->contact_web = "www.cooltra.com";
        $reward->contact_info = "Pepe: 66382423";
        $reward->exchange_latitude = 41.3889666;
        $reward->exchange_longitude = 2.1225654;
        $reward->save();

        $reward = new Reward;
        $reward->title = "Iron Maiden";
        $reward->points = 666;
        $reward->category_id = 1;
        $reward->end_date = \Carbon\Carbon::createFromDate(2017, 11, 30);;
        $reward->exchange_date = \Carbon\Carbon::createFromDate(2018, 5, 21);;
        $reward->description = "Ve al concierto del año!";
        $reward->exchange_info = "Desde tikketmaster";
        $reward->contact_web = "www.tikketsmaster.com";
        $reward->contact_info = "Javi Metal: 66306006";
        $reward->exchange_latitude = 41.3889666;
        $reward->exchange_longitude = 2.0225654;
        $reward->save();

        $reward = new Reward;
        $reward->title = "Port Aventura";
        $reward->points = 1000;
        $reward->category_id = 3;
        $reward->end_date = \Carbon\Carbon::createFromDate(2017, 31, 1);;
        $reward->exchange_date = \Carbon\Carbon::createFromDate(2018, 5, 21);;
        $reward->description = "Consigue un 2x1 en la entrada con esta reward";
        $reward->exchange_info = "Descarga la App";
        $reward->contact_web = "www.portaventura.com";
        $reward->contact_info = "Pepe: 66382423";
        $reward->exchange_latitude = 41.3889666;
        $reward->exchange_longitude = 2.1225654;
        $reward->save();

        $reward = new Reward;
        $reward->title = "Viaje a Andorra";
        $reward->points = 500;
        $reward->category_id = 2;
        $reward->end_date = \Carbon\Carbon::createFromDate(2017, 31, 1);;
        $reward->exchange_date = \Carbon\Carbon::createFromDate(2018, 5, 21);;
        $reward->description = "Viaja a Andorra con Autobuses Paco";
        $reward->exchange_info = "Descarga la App";
        $reward->contact_web = "www.autobusespaco.com";
        $reward->contact_info = "Paco: 66382423";
        $reward->exchange_latitude = 41.3889666;
        $reward->exchange_longitude = 2.1225654;
        $reward->save();

        $reward = new Reward;
        $reward->title = "Vuelta al Mundo";
        $reward->points = 2000000;
        $reward->category_id = 6;
        $reward->end_date = \Carbon\Carbon::createFromDate(2017, 31, 1);;
        $reward->exchange_date = \Carbon\Carbon::createFromDate(2018, 5, 21);;
        $reward->description = "Vuelta al mundo con todo pagado con aviones er cabesa";
        $reward->exchange_info = "Descarga la App";
        $reward->contact_web = "www.iberia.com";
        $reward->contact_info = "Er cabesa: 66382423";
        $reward->exchange_latitude = 41.3889666;
        $reward->exchange_longitude = 2.1225754;
        $reward->save();


    }
}
