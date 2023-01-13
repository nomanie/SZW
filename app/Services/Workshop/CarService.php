<?php

namespace App\Services\Workshop;

 use App\Models\Workshop\Cars\Car;
 use App\Models\Workshop\Clients\Client;

 class CarService
{
    protected Car $car;

     public function setCar(Car|int $car): static
     {
         if (gettype($car) === 'int')
         {
             $car = Car::find($car);
         }

         $this->car = $car;

         return $this;
     }

     public function saveOrUpdate(array $data, ?Car $car = null): Car
     {
         if ($car) {
             $this->setCar($car);
         } else {
             $this->car = new Car();
             $this->car->client_id = $data['client_id'];
         }

         $this->car->brand = $data['brand'];
         $this->car->model = $data['model'];
         $this->car->generation = $data['generation'];
         $this->car->seria = $data['seria'];
         $this->car->engine = $data['engine'];
         $this->car->car_type = $data['car_type'];
         $this->car->registration_number = $data['registration_number'];
         $this->car->vin_number = $data['vin_number'];
         $this->car->production_date = $data['production_date'];
         $this->car->distance = $data['distance'];
         $this->car->insurance_date = $data['insurance_date'];
         $this->car->inspection_date = $data['inspection_date'];
         $this->car->notes = $data['notes'];

         $this->car->save();

         return $this->car;
     }

     public function restore(int $id): Car|bool
     {
         $this->car = Car::find($id);
         if ($this->car->restore()) {
             return $this->car;
         }
         return false;
     }
}
