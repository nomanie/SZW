<?php

namespace App\Services\Workshop;


 use App\Models\Workshop\Clients\Client;

 class ClientService
{
     public function setClient(Client|int $client): static
     {
         if (gettype($client) === 'int')
         {
             $client = Client::find($client);
         }

         $this->client = $client;

         return $this;
     }
    public function saveOrUpdate(array $data, ?Client $client = null): Client
    {
        if ($client) {
            $this->setClient($client);
        } else {
            $this->client = new Client();
        }
        $this->client->first_name = $data['first_name'];
        $this->client->last_name = $data['last_name'];
        $this->client->phone = $data['phone'];
        $this->client->email = $data['email'];
        $this->client->date_of_birth = $data['date_of_birth'];
        $this->client->city = $data['city'];
        $this->client->street = $data['street'];
        $this->client->building_number = $data['building_number'];
        $this->client->flat_number = $data['flat_number'];
        $this->client->zip_code = $data['zip_code'];
//        $this->client->info = $data['info'];
        $this->client->save();

        return $this->client;
    }

    public function restore(int $id): Client|bool
    {
        $this->client = Client::find($id);
        if ($this->client->restore()) {
            return $this->client;
        }
        return false;
    }
}
