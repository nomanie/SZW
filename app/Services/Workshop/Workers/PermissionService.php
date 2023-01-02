<?php

namespace App\Services\Workshop\Workers;

 use App\Models\Workshop\Workers\Permission;
 use App\Models\Workshop\Workers\Worker;
 use Illuminate\Support\Facades\Session;

 class PermissionService
{
    protected Worker $worker;
    public function formatData(): array
    {
        $permissions = Permission::all();
        $sections = [];
        $data = [];

        //Tworzy odpowiednie sekcje dla uprawnień
        foreach ($permissions as $permission) {
            if (!in_array($permission, $sections)) {
                $sections[] = $permission->section;
            }
        }

        //Dodaje uprawnienia do danej sekcji
        foreach ($sections as $section) {
            $data[$section] = Permission::where('section', $section)->get();
        }

        return $data;
    }

    public function save(array $data, Worker $worker): bool
    {
        try {
            $this->worker = $worker;
            $this->worker->permissions()->detach();
            $this->worker->permissions()->attach($data);
            $this->worker->save();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
