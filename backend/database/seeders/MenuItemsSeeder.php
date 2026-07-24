<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Espresso', 'description' => 'Rich and bold single shot espresso', 'price' => 45.00, 'status' => 'Available'],
            ['name' => 'Cappuccino', 'description' => 'Espresso with steamed milk foam', 'price' => 65.00, 'status' => 'Available'],
            ['name' => 'Latte', 'description' => 'Smooth espresso with steamed milk', 'price' => 70.00, 'status' => 'Available'],
            ['name' => 'Mocha', 'description' => 'Chocolate flavored latte', 'price' => 80.00, 'status' => 'Available'],
            ['name' => 'Americano', 'description' => 'Espresso with hot water', 'price' => 50.00, 'status' => 'Available'],
            ['name' => 'Hot Chocolate', 'description' => 'Rich and creamy hot chocolate', 'price' => 60.00, 'status' => 'Available'],
            ['name' => 'Croissant', 'description' => 'Freshly baked butter croissant', 'price' => 55.00, 'status' => 'Available'],
            ['name' => 'Blueberry Muffin', 'description' => 'Fresh baked muffin with blueberries', 'price' => 50.00, 'status' => 'Available'],
            ['name' => 'Cheesecake', 'description' => 'Creamy New York style cheesecake', 'price' => 90.00, 'status' => 'Available'],
            ['name' => 'Tiramisu', 'description' => 'Classic Italian coffee dessert', 'price' => 95.00, 'status' => 'Available'],
        ];

        foreach ($items as $item) {
            MenuItem::create($item);
        }

        echo "10 menu items created!\n";
    }
}
