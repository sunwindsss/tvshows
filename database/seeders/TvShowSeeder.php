<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TvShow;
use Illuminate\Support\Facades\Storage;

class TvShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing images in the 'banners' directory
        $bannerPath = public_path('storage/banners');
        if (is_dir($bannerPath)) {
            $files = glob($bannerPath . '/*'); // Get all file names in the directory
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file); // Delete the file
                }
            }
        }

        TvShow::factory()->count(4)->create();
    }
}
