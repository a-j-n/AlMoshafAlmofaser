<?php

namespace App\Commands;

use App\QuranText;
use Intervention\Image\ImageManagerStatic as Image;
use LaravelZero\Framework\Commands\Command;

class CreateAyat extends Command
{

    protected $signature = 'image:create';


    protected $description = 'Create Images with quran Text';

    public function handle()
    {
        $ayat = QuranText::all();
        $bar = $this->output->createProgressBar(count($ayat));
        foreach ($ayat as $aya) {
            $img = Image::canvas(400, 200, '#000');
            $img->text($aya->text, 0, 0, function ($font) {
                $font->file('public/DroidKufi/DroidKufi-Bold.ttf');
                $font->size(24);
                $font->color('#fff');
                $font->align('center');
                $font->valign('top');
                $font->angle(0);
            });
            $img->save(public_path('images/'.$aya->sura . '_' . $aya->aya . '.jpg'), 80);

            $bar->advance();

        }
        $bar->finish();
    }


}
