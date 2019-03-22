<?php

namespace App\Console\Commands;

use App\Models\Cafeteria;
use App\Models\Category;
use App\Models\Product;
use App\Models\Faculty;
use Illuminate\Console\Command;
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
     * @return \Generator
     */
    public function filesInDir($directory, $fileExtension) {
        $directory = realpath($directory);
        $it = new \RecursiveDirectoryIterator($directory);
        $it = new \RecursiveIteratorIterator($it, \RecursiveIteratorIterator::LEAVES_ONLY);
        $it = new \RegexIterator($it, '(\.' . preg_quote($fileExtension) . '$)');
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
                /**
                 * @var string  $name
                 * @var string  $short_name
                 * @var string  $maps_url
                 * @var array   $cafeterias
                 */
                extract(Yaml::parse($content), EXTR_OVERWRITE);

                $bar = $this->getOutput()->createProgressBar();
                $bar->setFormat(ProgressBar::getFormatDefinition('normal_nomax') . ' | %message%');
                $bar->start();

                /** @var Faculty $faculty */
                $faculty = Faculty::firstOrCreate(compact('short_name'),
                    compact('name', 'maps_url'));

                foreach ($cafeterias as $cafeteria_content) {
                    /**
                     * @var string  $name
                     * @var array   $products
                     */
                    extract($cafeteria_content, EXTR_OVERWRITE);

                    /** @var Cafeteria $cafeteria */
                    $cafeteria = $faculty->cafeterias()->firstOrCreate(compact('name'));

                    foreach ($products as $product_content) {
                        /**
                         * @var string  $name
                         * @var string  $quantity
                         * @var string  $price
                         * @var string  $image
                         * @var array   $categories
                         */
                        extract($product_content, EXTR_OVERWRITE);

                        $bar->setMessage('Importing for ' . $faculty->short_name
                            . ' ➤ ' . $cafeteria->name . ' ➤ ' . $name);

                        /** @var Product $product */
                        $product = $cafeteria->products()->firstOrCreate(compact('name', 'quantity', 'price'),
                            compact('image'));

                        foreach ($categories as $name) {
                            /** @var Category $category */
                            $category = Category::firstOrCreate(compact('name'));

                            $product->categories()->save($category);
                        }

                        $bar->advance();
                    }

                    $bar->setProgress(0);
                }

                $bar->setMessage('Successfully imported all cafeterias of ' . $faculty->short_name);
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
