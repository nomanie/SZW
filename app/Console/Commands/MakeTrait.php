<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeTrait extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name : nazwa traita} {--system : Generowanie traita w folderze /System }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tworzy trait w app\Traits';

    /**
     * The extension of created file
     *
     * @var string
     */
    protected $ext = '.php';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name') . 'Trait';
        $dir = app_path('Traits/');

        if (file_exists($dir . $name . $this->ext)) {
            $this->error(__("Taki trait już istnieje!"));
            return 0;
        }

        $file = "<?php\n\nnamespace App\\Traits;\n\n trait " . $name . "\n{\n\n}";

        file_put_contents($dir . $name . $this->ext, $file);
        $this->info(__('Stworzono trait: ' . $name));

        return 0;
    }
}
