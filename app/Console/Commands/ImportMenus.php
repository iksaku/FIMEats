<?php

namespace App\Console\Commands;

use App\Models\Cafeteria;
use App\Models\Category;
use App\Models\Faculty;
use App\Models\Product;
use Generator;
use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class ImportMenus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:menus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Menus from Excel file';

    /**
     * @param $directory
     * @param $fileExtension
     * @return Generator
     */
    public function filesInDir($directory, $fileExtension)
    {
        $directory = realpath($directory);
        $it = new RecursiveDirectoryIterator($directory);
        $it = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::LEAVES_ONLY);
        $it = new RegexIterator($it, '(\.'.preg_quote($fileExtension).'$)');
        foreach ($it as $file) {
            yield $file->getPathname() => file_get_contents($file->getPathname());
        }
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating fresh Database...');

        if (! file_exists($db = config('database.connections.sqlite.database'))) {
            touch($db);
        }

        $this->callSilent('migrate:fresh', ['--force' => true]);

        $this->info('Importing Menus...');

        foreach ($this->filesInDir(resource_path('menus'), 'yaml') as $content) {
            try {
                /** @var array $data */
                $data = Yaml::parse($content);

                /* @var string $name */
                /* @var string $short_name */
                /* @var string $logo */
                /* @var string $maps_url */
                /* @var array $cafeterias */
                extract($data);

                $bar = $this->getOutput()->createProgressBar();

                $bar->setFormat(ProgressBar::getFormatDefinition('normal_nomax').' | %message%');
                $bar->setMessage('Loading...');
                $bar->start();

                /** @var Faculty $faculty */
                $faculty = Faculty::updateOrCreate(
                    compact('short_name'),
                    compact('name', 'logo', 'maps_url')
                );

                foreach ($cafeterias as $cafeteria_content) {
                    $bar->setProgress(0);

                    /* @var string $name */
                    /* @var array $products */
                    extract($cafeteria_content);

                    /** @var Cafeteria $cafeteria */
                    $cafeteria = $faculty->cafeterias()->firstOrCreate(compact('name'));

                    foreach ($products as $product_content) {
                        /* @var string $name */
                        /* @var string $quantity */
                        /* @var string $price */
                        /* @var string $image */
                        /* @var array $categories */
                        extract($product_content);

                        $bar->setMessage(
                            'Importing for '.$faculty->short_name.' ➤ '.$cafeteria->name.' ➤ '.$name
                        );

                        /** @var Product $product */
                        $product = $cafeteria->products()->firstOrCreate(
                            compact('name', 'quantity', 'price'),
                            compact('image')
                        );

                        foreach ($categories as $name) {
                            /** @var Category $category */
                            $category = Category::firstOrCreate(compact('name'));

                            $product->categories()->save($category);
                        }

                        $bar->advance();
                    }
                }

                $message = 'Successfully imported all cafeterias of '.$faculty->short_name;

                $bar->setMessage($message);
                $bar->finish();

                $this->line('');
            } catch (ParseException $e) {
                $this->error($e->getMessage());

                continue;
            }
        }
    }
}
