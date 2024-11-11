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
        // List of images to keep (5 custom shows)
        $protectedFiles = [
            'irtalants-5555.jpg',
            'kreta-5555.jpg',
            'laukuseta-5555.jpg',
            'randins-5555.jpg',
            'iemileties-5555.jpg',
        ];

        // Delete existing images in the 'banners' directory except the specific 5 images
        $bannerPath = public_path('storage/banners');
        if (is_dir($bannerPath)) {
            $files = glob($bannerPath . '/*'); // Get all file names in the directory
            foreach ($files as $file) {
                if (is_file($file) && !in_array(basename($file), $protectedFiles)) {
                    unlink($file); // Delete the file
                }
            }
        }

        // TvShow::factory()->count(10)->create();

        // Custom TV show entries
        $tvShows = [
            [
                'name' => 'Ir Talants!',
                'description' => 'Populārā britu producenta Saimona Kauela radītā "Got Talent" franšīze ir nonākusi līdz Latvijai.',
                'banner' => 'banners/irtalants-5555.jpg',
                'start_date' => '2024-10-17',
                'end_date' => '2024-11-20',
            ],
            [
                'name' => 'Krēta',
                'description' => 'Dzīve luksus villā, pievilcīgi dalībnieki, kaislīgi strīdi un pikantērijas – jaunajā šovā “Karsti. Krēta”. Skatītājiem būs iespēja ne vien sekot līdzi kaislībām, bet arī ietekmēt notikumu gaitu. Būs karsti! Uzzini karstākos šova notikumus aizraujošās epizodēs kanālā TV3 un Go3.',
                'banner' => 'banners/kreta-5555.jpg',
                'start_date' => '2024-11-05',
                'end_date' => '2024-11-20',
            ],
            [
                'name' => 'Lauku Sēta',
                'description' => '“Lauku sētā” darba daudz! Gadu no gada 12 azartiski un apņēmības pilni dalībnieki ir gatavi mesties iekšā lauku dzīves izaicinājumos, lai cīnītos par naudas balvu līdz pat 10 000 eiro. Katru nedēļu dalībniekus sagaida jauns darbs saimniecībā, par kuru viņi var nopelnīt papildus naudu balvas fondam un nedēļas beigās – viena dalībnieka izbalsošana. Šova vadītājs Jānis Rāzna pamanīs visu – gan sliņķus, gan čaklos, spēs motivēt, uzklausīs un neļaus slinkot.',
                'banner' => 'banners/laukuseta-5555.jpg',
                'start_date' => '2024-11-04',
                'end_date' => '2024-11-25',
            ],
            [
                'name' => 'Ēdienkartē Randiņš',
                'description' => 'Kulinārijas un iepazīšanās šovi ir vieni no populārākajiem televīzijas šoviem visā pasaulē. Līdz Latvijai nonācis jauns iepazīšanās šova formāts, kas tapis vairāk nekā 20 valstīs un sola abas šīs lietas apvienot vienā – jaunais TV3 iepazīšanās šovs “Ēdienkartē randiņš”. Brīvo siržu īpašniekiem aizvien ir iespēja pieteikties šovam un gūt unikālu randiņu pieredzi.',
                'banner' => 'banners/randins-5555.jpg',
                'start_date' => '2024-09-25',
                'end_date' => '2024-11-27',
            ],
            [
                'name' => 'Laiks Iemīlēties',
                'description' => 'Iepazīšanās šovs, kurā dalībnieki dodas uz aklo randiņu ar pilnīgi nepazīstamu partneri, taču randiņa vietā viņi.. sāk dzīvot kopā! Pēc kopā pavadītām 24 stundām romantiskos apartamentos, dalībnieki izvēlas – šķirties vai turpināt šovu.',
                'banner' => 'banners/iemileties-5555.jpg',
                'start_date' => '2024-11-08',
                'end_date' => '2024-12-01',
            ],
        ];

        foreach ($tvShows as $tvShow) {
            TvShow::create($tvShow);
        }
    }
}
