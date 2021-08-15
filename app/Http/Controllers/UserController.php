<?php

namespace App\Http\Controllers;
use App\Models\User;
use DateTime;
use DateTimeZone;
class UserController extends Controller
{
    public function get_birthday($id) {
        $user = User::where('id',$id)->first();       

        $name = $user->name;
        $birthday = $user->birthday;
        $timezone = $user->timezone;
        $now = new DateTime("now", new \DateTimeZone($timezone));  
        $birthday_month = date("m",strtotime($birthday));
        $birthday_day = date("d",strtotime($birthday));
        $birthday_obj =  new DateTime($birthday);
        $birthday_this_year = date("Y")."-".$birthday_month."-".$birthday_day;
        $birthday_this_year_obj =  new DateTime($birthday_this_year);
        $interval = $now->diff($birthday_this_year_obj);
        $age_that_we_wish = $now->diff($birthday_obj)->y;
        $real_age = $age_that_we_wish +1;
        if ($interval->m == 0 && $interval->d == 0) {
            return "It is ".$name."'s birthday in ". $timezone;
         }  
        else {
            return $name. " will be ".$real_age." years old in ".$interval->m." months and ".$interval->d." days in ". $timezone; 
        }         
   }
}
