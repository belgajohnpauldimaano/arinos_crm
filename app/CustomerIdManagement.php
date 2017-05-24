<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerIdManagement extends Model
{
    protected $primaryKey = 'customer_id';

    public static function update_customer_id(){

        $ciManagement = CustomerIdManagement::all()->last();

        if($ciManagement){
            
            //update
            $customer_id = $ciManagement->customer_id + 1;
            
        } else {
            
            //insert
            $ciManagement = new CustomerIdManagement;
            $customer_id = 1;

        }

        $ciManagement->customer_id = $customer_id;
        $ciManagement->save();

        return $customer_id;

    }

}
