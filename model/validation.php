<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 3/9/18
 * Time: 12:09 AM
 */

function validFirst($name) {
    if(empty($name)){
        return false;
    }
    return ctype_alpha($name);
}

function validLast($name) {
    if(empty($name)){
        return false;
    }
    return ctype_alpha($name);
}

function validBirth($date) {
    if(empty($date)){
        return false;
    }
    return true;
}

function validPhone($phone) {
    if(empty($name)){
        return true;
    } else {
        return (is_numeric($phone) && (strlen($phone) > 9 && (strlen($phone) < 16)));
    }
}

function validZip($zip){
    if(empty($zip)){
        return true;
    }
    return (strlen($zip) == 5) && (is_numeric($zip));
}

function validIncome($income){
    return empty($income) || is_numeric($income);
}

function validRent($rent){
    return empty($rent) || is_numeric($rent);
}

function validfoodstamps($stamps){
    return empty($stamps) || is_numeric($stamps);
}

function validGender($gender){
    return isset($gender);
}

function validAddSupport($support){
    return empty($support) || is_numeric($support);
}
