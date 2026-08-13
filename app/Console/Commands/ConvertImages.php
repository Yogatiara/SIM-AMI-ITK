<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Format;
class ConvertImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:convert {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert PNG images to WebP';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('filename');

        $input = public_path('images/' . $filename);

        if (!file_exists($input)) {
            $this->error("File {$filename} tidak ditemukan.");

            return Command::FAILURE;
        }

        $image = Image::decodePath($input);

        $outputFilename = pathinfo($filename, PATHINFO_FILENAME) . '.webp';

        $output = public_path('images/' . $outputFilename);

        $encoded = $image->encodeUsingFormat(
            Format::WEBP,
            quality: 80
        );

        $encoded->save($output);

        $this->info("Berhasil: {$filename} → {$outputFilename}");

        return Command::SUCCESS;
    }
}
