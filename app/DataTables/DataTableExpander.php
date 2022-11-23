<?php
namespace App\DataTables;

trait DataTableExpander
{
    public function getLanguageByName(string $name = 'pl'): string
    {
        return url('/lang/'. $name .'/datatables.json');
    }

    public function getLanguageByLocale(): string
    {
        return url('/lang/'. app()->getLocale() .'/datatables.json');
    }
}
