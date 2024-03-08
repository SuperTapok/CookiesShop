<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ActivitySeeder::class,
            CategoriesSeeder::class,
            PlacesSeeder::class,
            ItemsSeeder::class,
            ThemesSeeder::class,
            ProviderSeeder::class,
            CoursesSeeder::class,
            CourseThemeSeeder::class,
            ProductsSeeder::class,
            ImagesSeeder::class,
            ProductImageSeeder::class,
            UserTypesSeeder::class,
            CompaniesSeeder::class,
            PositionsSeeder::class,
            EmployeesSeeder::class,
            EmployeeActivitySeeder::class,
            UsersSeeder::class,
            OrdersSeeder::class,
            OrdersProductSeeder::class,
        ]);
    }
}
