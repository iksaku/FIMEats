<?php

namespace App\Console\Commands;

use App\Models\Cafeteria;
use App\Models\Category;
use App\Models\Consumable;
use App\Models\Faculty;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

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

    private function trim_cell($cell) {
        if ($cell instanceof Cell) return ltrim(rtrim($cell->getValue()));
        return $cell;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $console = new ConsoleOutput();
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'menus.xlsx';

        if (!file_exists($file)) {
            $console->writeln(__DIR__);
            $console->writeln('<warning>No "Menu" file... Aborting...</warning>');
            return false;
        }

        $console->writeln('<info>Importing Menus...</info>');

        try {
            /** @var Xlsx $reader */
            $reader = IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($file);

            for ($i = 0; $i < $spreadsheet->getSheetCount(); ++$i) {
                $spreadsheet->setActiveSheetIndex($i);
                $worksheet = $spreadsheet->getActiveSheet();

                $bar = new ProgressBar($console, $max = ($worksheet->getHighestRow() - 1));
                $bar->setProgressCharacter('>');
                $bar->setBarCharacter('•');
                $bar->setEmptyBarCharacter('-');
                $bar->setMessage('Starting...');
                $bar->setFormat(str_repeat(' ', 5 - strlen((string) $max)) . "%current%/%max%" . str_repeat(' ', 5 - strlen((string) $max)) . "[%bar%] %percent%% | %message%");
                $bar->start();

                $faculty_name = $this->trim_cell($worksheet->getCellByColumnAndRow(5, 5));
                $faculty_short_name = $this->trim_cell($spreadsheet->getSheetNames()[$i]);
                $faculty_maps_url = $this->trim_cell($worksheet->getCellByColumnAndRow(5, 2, false));
                $embeddable_maps_url = null;

                if (!empty($faculty_maps_url)) {
                    preg_match('/src="([a-zA-Z0-9:\/.?=!\-\%\+]+)"/', $faculty_maps_url, $matches);
                    if (isset($matches[1])) $embeddable_maps_url = $matches[1];
                }

                $faculty = Faculty::firstOrCreate(['short_name' => $faculty_short_name], [
                    'name' => $faculty_name
                ]);
                $faculty->maps_url = $embeddable_maps_url;
                $faculty->save();

                $cafeteria = Cafeteria::firstOrNew(['faculty_id' => $faculty->id], [
                    'name' => 'Cafetería de ' . $faculty->short_name
                ]);
                $faculty->cafeterias()->save($cafeteria);

                foreach ($worksheet->getRowIterator() as $row) {
                    if ($row->getRowIndex() == 1) continue;

                    $consumable_categories = explode(',', preg_replace(
                        '/( |),( |)/',
                        ',',
                        $worksheet->getCellByColumnAndRow(1, $row->getRowIndex())
                    ));

                    $consumable_name = $this->trim_cell($worksheet->getCellByColumnAndRow(2, $row->getRowIndex()));
                    $consumable_img = $this->trim_cell($worksheet->getCellByColumnAndRow(4, $row->getRowIndex(), false));
                    $consumable_price = preg_replace(
                        '/(\$)([0-9.]+)/',
                        '$2',
                        $this->trim_cell($worksheet->getCellByColumnAndRow(3, $row->getRowIndex()))
                    );

                    if ($consumable_price == '') continue;

                    $bar->setMessage('Importing "' . $faculty->short_name . '" ➤ ' . $consumable_name);

                    $consumable = Consumable::firstOrNew([
                        'name' => $consumable_name,
                        'price' => (float) $consumable_price,
                        'cafeteria_id' => $cafeteria->id
                    ]);
                    $consumable->image = $consumable_img;
                    $cafeteria->consumables()->save($consumable);

                    foreach($consumable_categories as $consumable_category) {
                        if (empty($consumable_categories)) continue;
                        $category = Category::firstOrCreate(['name' => $this->trim_cell($consumable_category)]);

                        if (!$consumable->categories->contains($category->id)) $consumable->categories()->save($category);
                    }

                    $bar->advance();
                }

                $bar->setMessage('<info>Successfully Imported Menus from "' . $faculty->short_name . '"</info>');
                $bar->finish();
                $console->writeln('');
            }
        } catch (\Exception $e) {
            $console->writeln('<error>' . $e->getMessage() . '</error>');
            return false;
        }

        return true;
    }
}
