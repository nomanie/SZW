<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name} {--dir=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tworzy nowy service';

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
        $name = $this->argument('name') . 'Service';
        $dir = app_path('Services/') . $this->option('dir') . '/';
        if (file_exists($dir . $name . $this->ext)) {
            $this->error(__("Taki Service już istnieje!"));
            return 0;
        }
        $file = "<?php\n\nnamespace App\\Services\\".$this->option('dir').";\n\n class " . $name . "\n{\n\n}";
        file_put_contents($dir . $name . $this->ext, $file);
        $this->info(__('Stworzono service: ' . $name));

        return 0;
    }
}
