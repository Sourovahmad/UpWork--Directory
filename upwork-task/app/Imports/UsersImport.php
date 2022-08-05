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
            "email" => $row['reg_no'],
            "name" => $row['name'],
            "gender" => $row['gender'],
            "marital_status" => $row['marital_status'],
            "mangalik_status" => $row['mangalik_status'], 
            "birth_date" => $row['birth_date'],
            "image_file" => $row['image_file'],
            "password" => $row['password'],




            'payment' => $row['payment'],
            'facebook' => $row['facebook'],
            'insta' => $row['insta'],
            'mobile_no' => $row['mobile_no'],
            'address' => $row['address'],
            'father_name' => $row['father_name'],
            'father_occuption' => $row['father_occuption'],
            'mother_name' => $row['mother_name'],
            'mother_occuption' => $row['mother_occuption'],
            'month' => $row['month'],
            'year' => $row['year'],
            'birth_city' => $row['birth_city'],
            'height' => $row['height'],
            'complexion' => $row['complexion'],
            'occupation' => $row['occupation'],
            'income' => $row['income'],
            'education_qualification' => $row['education_qualification'],
            'drinking' => $row['drinking'],
            'eating' => $row['eating'],
            'weight' => $row['weight'],
            'smoker' => $row['smoker'],
            'relation' => $row['relation'],
            'number' => $row['number'],
            'bussiness_and_company_name' => $row['bussiness_and_company_name'],
            'family_gotra' => $row['family_gotra'],
            'working_city' => $row['working_city'],
            'min_income' => $row['min_income'],
            'rashi' => $row['rashi'],
            'preference' => $row['preference'],
            'rname' => $row['rname'],
            'additional' => $row['additional'],
            'brothers' => $row['brothers'],
            'sisters' => $row['sisters'],
            'designation' => $row['designation'],
            'time' => $row['time'],
        ]);
    }
}
