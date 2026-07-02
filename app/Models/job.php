<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class job
{
    public static function getAllJobs()
    {
        return [
            ["titel"=>"Laravel Developer" ,"Salary"=> "3000"],
            ["titel"=> "Graphic Designer" ,"Salary"=> "2000"]
        ];
    }
}
