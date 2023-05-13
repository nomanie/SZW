<?php

namespace App\Services\Workshop;


 use App\Models\Workshop\Clients\Client;
 use Illuminate\Support\Facades\Session;

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
        $this->client->consent_marketing_notification = $data['consent_marketing_notification'] ?? 0;
        $this->client->consent_sms_notification = $data['consent_sms_notification'] ?? 0;
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

    public function connect(int $id): Client|bool
    {
        //@todo łączenie identity klienta z klientem w bazie
    }

    public function disconnect(int $id): Client|bool
    {
        //@todo odłączanie identity od klienta
    }
}
