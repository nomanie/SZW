<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeContract extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:contract {name} {--dir=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tworzy nowy contract';

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
        $name = $this->argument('name') . 'Contract';
        $dir = app_path('Contracts/') . $this->option('dir') . '/';
        if (file_exists($dir . $name . $this->ext)) {
            $this->error(__("Taki Contract już istnieje!"));
            return 0;
        }
        $file = "<?php\n\nnamespace App\\Contracts\\".$this->option('dir').";\n\n interface " . $name . "\n{\n\n}";
        file_put_contents($dir . $name . $this->ext, $file);
        $this->info(__('Stworzono service: ' . $name));

        return 0;
    }
}
