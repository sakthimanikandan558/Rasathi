<?php

namespace Database\Seeders;

use App\Models\customer;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'Name' => 'John Doe',
                'shipping_address' => '123 Main St, Anytown',
                'email' => 'john.doe@example.com',
                'phone' => '1234567890',
                
            ],
            [
                'Name' => 'Jane Smith',
                'shipping_address' => '456 Elm St, Othertown',
                'email' => 'jane.smith@example.com',
                'phone' => '0987654321',
                
            ],
            [
                'Name' => 'Michael Johnson',
                'shipping_address' => '789 Maple Ave, Smallville',
                'email' => 'michael.johnson@example.com',
                'phone' => '5678901234',
                
            ],
            [
                'Name' => 'Sarah Brown',
                'shipping_address' => '321 Oak St, Villagetown',
                'email' => 'sarah.brown@example.com',
                'phone' => '6758493021',
                
            ],
            [
                'Name' => 'Robert Davis',
                'shipping_address' => '555 Pine Rd, Countryside',
                'email' => 'robert.davis@example.com',
                'phone' => '2345678901',
                
            ],
            [
                'Name' => 'Emma Johnson',
                'shipping_address' => '987 Cedar Ave, Hometown',
                'email' => 'emma.johnson@example.com',
                'phone' => '8765432109',
                
            ],
            [
                'Name' => 'David Lee',
                'shipping_address' => '654 Birch St, Lakeview',
                'email' => 'david.lee@example.com',
                'phone' => '1098765432',
                
            ],
            [
                'Name' => 'Lisa Taylor',
                'shipping_address' => '222 Elmwood Dr, Riverside',
                'email' => 'lisa.taylor@example.com',
                'phone' => '9087654321',
                
            ],
            [
                'Name' => 'Kevin Adams',
                'shipping_address' => '777 Oak Ave, Hillside',
                'email' => 'kevin.adams@example.com',
                'phone' => '5678909876',
                
            ],
            [
                'Name' => 'Jessica Wilson',
                'shipping_address' => '888 Pine St, Mountainside',
                'email' => 'jessica.wilson@example.com',
                'phone' => '2345678909',
                
            ],
            [
                'Name' => 'Andrew Carter',
                'shipping_address' => '444 Maple Rd, Lakeside',
                'email' => 'andrew.carter@example.com',
                'phone' => '7654321098',
                
            ],
            [
                'Name' => 'Michelle Brown',
                'shipping_address' => '111 Cedar Ave, Cityview',
                'email' => 'michelle.brown@example.com',
                'phone' => '9876543210',
                
            ],
            [
                'Name' => 'Ryan Miller',
                'shipping_address' => '333 Oakwood Ln, Townsville',
                'email' => 'ryan.miller@example.com',
                'phone' => '8765432101',
                
            ],
            [
                'Name' => 'Emily White',
                'shipping_address' => '555 Maple Ave, Riverview',
                'email' => 'emily.white@example.com',
                'phone' => '1230987654',
                
            ],
            [
                'Name' => 'Jacob Robinson',
                'shipping_address' => '777 Elm St, Lakeshore',
                'email' => 'jacob.robinson@example.com',
                'phone' => '8765432102',
                
            ],
            [
                'Name' => 'Olivia Clark',
                'shipping_address' => '999 Cedar Rd, Mountainview',
                'email' => 'olivia.clark@example.com',
                'phone' => '4567890123',
                
            ],
            [
                'Name' => 'Daniel Hall',
                'shipping_address' => '444 Pine Ave, Brookside',
                'email' => 'daniel.hall@example.com',
                'phone' => '8901234567',
                
            ],
            [
                'Name' => 'Sophia Young',
                'shipping_address' => '222 Oakwood Dr, Greenfield',
                'email' => 'sophia.young@example.com',
                'phone' => '2345678908',
                
            ],
            [
                'Name' => 'William Harris',
                'shipping_address' => '888 Maple Ave, Riverdale',
                'email' => 'william.harris@example.com',
                'phone' => '7654321098',
                
            ],
            [
                'Name' => 'Grace Martinez',
                'shipping_address' => '333 Elmwood Ln, Springville',
                'email' => 'grace.martinez@example.com',
                'phone' => '6543210987',
                
            ],
           
        ];

        foreach ($customers as $customer) {
            customer::create($customer);
        }
    }
}
