<?php

namespace App\Services\Workshop;

use App\Models\System\Workshop;
use App\Models\Workshop\WorkshopInformations\WorkshopAdditionalField;
use App\Models\Workshop\WorkshopInformations\WorkshopContactForm;
use App\Models\Workshop\WorkshopInformations\WorkshopPlace;
use Exception;
use Illuminate\Support\Facades\DB;

class WorkshopService
{
    public function __construct(
        protected Workshop $workshop = new Workshop()
    )
    {
    }

    public function setWorkshop(Workshop $workshop): static
    {
        $this->workshop = $workshop;

        return $this;
    }

    public function update(mixed $data): Workshop|bool
    {
        DB::beginTransaction();
        try {
            switch ($data['section']) {
                case 'info':
                    $this->workshop->name = $data['name'];
                    $this->workshop->nip = $data['nip'];
                    $this->workshop->regon = $data['regon'];
                    $this->workshop->company_created_at = $data['company_created_at'];
                    $this->workshop->owners = $data['owners'];
                    break;
                case 'contact':
                    $this->workshop->phone = $data['phone'];
                    $this->workshop->email = $data['email'];
                    $this->workshop->website = $data['website'];
                    $this->workshop->social_media = $data['social_media'];
                    break;
                case 'places':
                    $this->savePlaces($data['places']);
                    break;
                case 'contact_form':
                    $this->saveForm($data);
                    break;
                case 'additional_fields':
                    $this->saveFields($data['fields']);
                    break;
                case 'map':
                    $this->saveMap($data);
                    break;
            }$this->workshop->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }

        return $this->workshop;
    }

    /**
     * @throws Exception
     */
    protected function savePlaces(array $data): void
    {
        DB::beginTransaction();
        try {
            $this->workshop->places()->delete();
            foreach ($data as $place) {
                $new_place = new WorkshopPlace();
                $new_place->city = $place['city'];
                $new_place->phone = $place['phone'];
                $new_place->street = $place['street'];
                $new_place->zip_code = $place['zip_code'];
                $new_place->building_number = $place['building_number'];
                $new_place->flat_number = $place['flat_number'];
                $new_place->workshop_id = $this->workshop->id;
                $new_place->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new Exception;
        }
    }

    /**
     * @throws Exception
     */
    protected function saveForm(array $data): void
    {
        DB::beginTransaction();
        try {
            $this->workshop->contactForm()->delete();
            $form = new WorkshopContactForm();
            $form->view = $data['view'];
            $form->fields = $data['fields'];
            $form->workshop_id = $this->workshop->id;
            $form->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new Exception;
        }
    }

    /**
     * @throws Exception
     */
    protected function saveFields(array $data): void
    {
        DB::beginTransaction();
        try {
            $this->workshop->additionalFields()->delete();
            foreach ($data as $field) {
                $new_field = new WorkshopAdditionalField();
                $new_field->name = $field['name'];
                $new_field->type = $field['type'];
                $new_field->value = $field['value'];
                $new_field->workshop_id = $this->workshop->id;
                $new_field->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new Exception;
        }
    }

    protected function saveMap(array $data): void
    {
        // @todo dodawanie znaczników na mapie
        // @todo dodać do workshop_places lat i lng
    }
}
