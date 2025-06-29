<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    private array $products = [
        [
            'name' => 'Смартфон Samsung Galaxy S23',
            'description' => 'Флагманский смартфон с AMOLED-экраном 6.1" и тройной камерой 50 МП',
            'price' => 79990.00
        ],
        [
            'name' => 'Ноутбук ASUS ZenBook 14',
            'description' => 'Ультрабук с процессором Intel Core i7 и SSD 512 ГБ',
            'price' => 89990.00
        ],
        [
            'name' => 'Наушники Sony WH-1000XM5',
            'description' => 'Беспроводные наушники с шумоподавлением и автономностью 30 часов',
            'price' => 34990.00
        ],
        [
            'name' => 'Кофемашина DeLonghi Magnifica',
            'description' => 'Автоматическая кофемашина для приготовления эспрессо и капучино',
            'price' => 45990.00
        ],
        [
            'name' => 'Фитнес-браслет Xiaomi Mi Band 7',
            'description' => 'Трекер активности с AMOLED-экраном и мониторингом SpO2',
            'price' => 3990.00
        ],
        [
            'name' => 'Умная колонка Яндекс Станция 2',
            'description' => 'Голосовой помощник Алиса с качественным звуком и поддержкой умного дома',
            'price' => 12990.00
        ],
        [
            'name' => 'Электросамокат Ninebot Max G30',
            'description' => 'Мощный самокат с запасом хода 55 км и максимальной скоростью 30 км/ч',
            'price' => 59990.00
        ],
        [
            'name' => 'Фотоаппарат Canon EOS R50',
            'description' => 'Беззеркальная камера с матрицей 24.2 МП и 4K-видео',
            'price' => 75990.00
        ],
        [
            'name' => 'Игровая консоль PlayStation 5',
            'description' => 'Новейшая игровая консоль с SSD 825 ГБ и поддержкой 4K 120Hz',
            'price' => 69990.00
        ],
        [
            'name' => 'Электрическая зубная щетка Oral-B iO8',
            'description' => 'Умная щетка с инновационной технологией очистки и дисплеем',
            'price' => 14990.00
        ]
    ];

    public function run(): void
    {
        $categories = Category::pluck('id');

        foreach (range(1, 20) as $i) {
            $productData = $this->products[array_rand($this->products)];
            Product::create([
                ...$productData,
                'category_id' => $categories->random(),
            ]);
        }
    }
}
