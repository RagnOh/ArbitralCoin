<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DataLayer;
use App\Models\UserPreferences;
use App\Models\Exchange;
use App\Models\Mockup;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->populateDB();
    }

    private function populateDB()
    {
        User::create([
            'username' => 'mik2',
            'email' => 'mik2@unibs.it',
            'password' => md5('12345678'),
            'admin' => '1',
            'pagante' => '1',
            'giorno_pagato' => date('Y-m-d')
        ]);

        $dl = new DataLayer();

        $user= $dl->getUserId('mik2@unibs.it');

        UserPreferences::factory()->count(1)->create(['user_id' => $user,'valuta'=>'USDT']);
        
        $exchanges = ['Binance','Kraken','Cryptocom'];

        foreach($exchanges as $exchange)
        {
            Exchange::create(['user_id' => $user, 'name' =>$exchange]);
        }

        $list=array('Binance');
        $pairs=$dl->getCommonsPairs($list);

        foreach($pairs as $pair=>$element)
        {
            Mockup::factory()->create(['exchange'=>"Mockup",'pair'=>$element]);
        }


    }
}
