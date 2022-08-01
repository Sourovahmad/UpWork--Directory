<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            "reg_no" => $row['reg_no'],
            "name" => $row['name'],
            "gender" => $row['gender'],
            "marital_status" => $row['marital_status'],
            "mangalik_status" => $row['mangalik_status'], 
            "birth_date" => $row['birth_date'], 
            "state" => $row['state'], 
            "image_file" => $row['image_file'],
            "password" => Hash::make($row['password'])
        ]);
    }
}
