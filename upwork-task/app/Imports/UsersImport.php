<?php

namespace App\Imports;

use App\Models\User;
use Carbon\Carbon;
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


        $birth_date =  $row['day'];
        $parsed = Carbon::createFromFormat('d/m/Y', $birth_date)->format('Y');


        return new User([
            "reg_no" => $row['id'],
            "email" => $row['id'],
            "name" => $row['name'],
            "gender" => $row['gender'],
            "marital_status" => $row['status'],
            "mangalik_status" => $row['managl'], 
            "birth_date" => $row['day'],
            "image_file" => $row['image'],
            "password" => $row['password'],
            "state" => $row['state'],




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
            'year' => $parsed,
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
            'rnumber' => $row['rnumber'],
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
