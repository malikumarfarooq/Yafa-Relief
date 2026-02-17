<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OurTodo;

class WhatWeDoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $our_todos = [
            [
                "title" => "Food Security & Hot Meals",
                "description" => "Yafa  Relief provide nutritious food parcels and hot meals to families facing hunger and food insecurity, especially those impacted by conflict and displacement.",
                'image' => '/src/images/our-todo/food.jpg'
            ],
            [
                "title" => "Health & Medical Support",
                "description" => "Yafa Relief supplies essential medicines, medical kits, and nutrition support to vulnerable people, with emphasis on children, pregnant women, and those in need of urgent healthcare.",
                'image' => '/src/images/our-todo/water.jpg'
            ],
            [
                "title" => "Child Protection & Orphan Support",
                "description" => "Yafa  Relief care for children through orphan sponsorship, psychosocial support, safe spaces, and educational assistance to protect their wellbeing and future.",
                'image' => '/src/images/our-todo/education.png'
            ],
            [
                "title" => "Emergency Survival Kits & Crisis Aid",
                "description" => "In emergencies, Yafa  Relief distribute life-saving survival kits — including shelter materials, hygiene essentials, and supplies for displaced families.",
                'image' => '/src/images/our-todo/general.jpg'
            ],
            [
                "title" => "Gaza Emergency & Rapid Response Fund",
                "description" => "Yafa  Relief maintain an emergency fund that allows immediate humanitarian action where needs are most critical, ensuring fast delivery of assistance during crises.",
                'image' => '/src/images/our-todo/gaza.jpg'
            ],
            [
                "title" => "Winter Relief & Warm Clothing",
                "description" => "During cold months, the organization provides winter clothing, blankets, and other protective items to help families and children stay warm.",
                'image' => '/src/images/our-todo/emergency-fund.jpg'
            ]
        ];

        foreach ($our_todos as $todo) {
            OurTodo::create($todo);
        }
    }
}
