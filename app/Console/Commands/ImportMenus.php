<?php

namespace App\Console\Commands;

use App\Cafeteria;
use App\Category;
use App\Faculty;
use App\Product;
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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

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
            $fileName = $file->getPathname();
            yield $fileName => file_get_contents($fileName);
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Cleaning up Database...');
        $this->callSilent('migrate:fresh', ['--force' => true]);
        $this->info('Importing Menus...');

        foreach ($this->filesInDir(resource_path('menus'), 'yaml') as $content) {
            try {
                /** @var array $data */
                $data = Yaml::parse($content);
                /** @var string $name */
                $name = $data['name'];
                /** @var string $short_name */
                $short_name = $data['short_name'];
                /** @var string $logo */
                $logo = $data['logo'];
                /** @var string $maps_url */
                $maps_url = $data['maps_url'];
                /** @var array $cafeterias */
                $cafeterias = $data['cafeterias'];

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

                    /** @var string $name */
                    $name = $cafeteria_content['name'];
                    /** @var array $products */
                    $products = $cafeteria_content['products'];

                    /** @var Cafeteria $cafeteria */
                    $cafeteria = $faculty->cafeterias()->firstOrCreate(compact('name'));

                    foreach ($products as $product_content) {
                        /** @var string $name */
                        $name = $product_content['name'];
                        /** @var string $quantity */
                        $quantity = $product_content['quantity'];
                        /** @var string $price */
                        $price = $product_content['price'];
                        /** @var string $image */
                        $image = $product_content['image'];
                        /** @var array $categories */
                        $categories = $product_content['categories'];

                        $bar->setMessage('Importing for '.$faculty->short_name
                            .' ➤ '.$cafeteria->name.' ➤ '.$name);

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

                $bar->setMessage('Successfully imported all cafeterias of '.$faculty->short_name);
                $bar->finish();
                $this->line('');
            } catch (ParseException $e) {
                $this->error($e->getMessage());

                continue;
            }
        }

        return true;
    }
}
