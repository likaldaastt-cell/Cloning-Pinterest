<?php
namespace Database\Seeders;
use App\Models\Pin;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create(['name' => 'Demo User', 'email' => 'demo@example.com']);
        $users = User::factory(3)->create();

        foreach ($users as $user) {
            $board = $user->boards()->create([
                'name' => 'Inspirasi ' . $user->name,
                'description' => 'Koleksi contoh',
            ]);

            for ($i = 1; $i <= 6; $i++) {
                $board->pins()->create([
                    'user_id' => $user->id,
                    'title' => "Pin {$i} dari {$user->name}",
                    'description' => 'Contoh pin',
                    'image_url' => "https://picsum.photos/seed/{$user->id}-{$i}/400/" . rand(300, 600),
                    'category' => Pin::CATEGORIES[array_rand(Pin::CATEGORIES)],
                ]);
            }
        }
    }
}