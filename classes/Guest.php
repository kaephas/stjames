<?php
/**
 * Created by PhpStorm.
 * User: Alex, Pavel
 * Date: 3/7/2018
 * Time: 12:55 PM
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * Class Guest.class represents a guest of the St.James Outreach Church
 *
 */
class Guest
{
    protected $fname;
    protected $lname;
    protected $birthdate;
    protected $phone;
    protected $email;
    protected $ethnicity;
    protected $street;
    protected $city;
    protected $zip;
    protected $license;
    protected $pse;
    protected $water;
    protected $income;
    protected $rent;
    protected $foodStamp;
    protected $addSupport;
    protected $mental;
    protected $physical;
    protected $veteran;
    protected $homeless;
    protected $notes;

    /**
     * Guest.class constructor.
     * @param $fname first name of guest
     * @param $lname last name of guest
     * @param $birthdate birthdate of guest
     */
    function __construct($fname,$lname,$birthdate){
        $this->fname = $fname;
        $this->lname = $lname;
        $this->birthdate = $birthdate;
    }
    //Setters and getters

    /**
     * Gets first name of guest
     * @return first first name
     */
    public function getfname(){
        return $this->fname;
    }

    /**
     * Sets the first name of guest
     * @param $name first name
     */
    public function setfname($name){
        $this->fname = $name;
    }

    /**
     * Setter for last name
     * @param $name last name
     */
    public function setlname($name){
        $this->lname = $name;
    }

    /**
     * Getter for last name
     * @return last last name
     */
    public function getlname(){
        return $this->lname;
    }

    /**
     * Setter for birthdate
     * @param $date date of birth
     */
    public function setBirthdate($date){
        $this->birthdate = $date;
    }

    /**
     * Getter for date of birth
     * @return birthdate date of birth
     */
    public function getBirthdate(){
        return $this->birthdate;
    }

    /**
     * Setter for phone number
     * @param $phone phone number of guest
     */
    public function setPhone($phone){
        $this->phone = $phone;
    }

    /**
     * Getter for phone number
     * @return phone phone number
     */
    public function getPhone(){
        return $this->phone;
    }

    /**
     * Setter for email
     * @param $email email of guest
     */
    public function setEmail($email){
        $this->email = $email;
    }

    /**
     * Getter for email
     * @return email of user
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * Setter for ethnicity
     * @param $eth ethnicity of guest
     */
    public function setEthnicity($eth){
        $this->ethnicity = $eth;
    }

    /**
     * Getter for ethnicity
     * @return ethnicty of guest
     */
    public function getEthnicity(){
        return $this->ethnicity;
    }

    /**
     * Setter for street
     * @param $street street of guest
     */
    public function setStreet($street){
        $this->street = $street;
    }

    /**
     * Getter for street
     * @return street of guest
     */
    public function getStreet(){
        return $this->street;
    }

    /**
     * Setter for city
     * @param $city city of guest
     */
    public function setCity($city){
        $this->city = $city;
    }

    /**
     * Getter for city
     * @return city of guest
     */
    public function getCity(){
        return $this->city;
    }

    /**
     * Setter fot zip code
     * @param $zip zip of guest
     */
    public function setZip($zip){
        $this->zip = $zip;
    }

    /**
     * Getter for zip code
     * @return zip code of guest
     */
    public function getZip(){
        return $this->zip;
    }

    /**
     * Setter for licence
     * @param $license licence of guest
     */
    public function setLicense($license){
        $this->license = $license;
    }

    /**
     * Getter for license
     * @return license number of guest
     */
    public function getLicense(){
        return $this->license;
    }

    /**
     * Setter for puget sound energy number
     * @param $pse puget sound energy number of guest
     */
    public function setPse($pse){
        $this->pse = $pse;
    }

    /**
     * Getter fot puget sound energy number
     * @return pse puget sound energy number of guest
     */
    public function getPse(){
        return $this->pse;
    }

    /**
     * Setter for water number
     * @param $water water number of guest
     */
    public function setWater($water){
        $this->water = $water;
    }

    /**
     * Getter for water number of guest
     * @return water number of guest
     */
    public function getWater(){
        return $this->water;
    }

    /**
     * Getter for rent number
     * @return rent number of guest
     */
    public function getRent()
    {
        return $this->rent;
    }

    /**
     * Setter for rent number
     * @param $rent number of guest
     */
    public function setRent($rent)
    {
        $this->rent = $rent;
    }


    /**
     * Getter for income number
     * @return income of guest
     */
    public function getIncome()
    {
        return $this->income;
    }

    /**
     * Setter for income number
     * @param $income number pf guest
     */
    public function setIncome($income)
    {
        $this->income = $income;
    }

    /**
     * Getter for food stamp number
     * @return foodStamp number of guest
     */
    public function getFoodStamp()
    {
        return $this->foodStamp;
    }

    /**
     * Setter for food stamp number
     * @param $foodStamp number of guest
     */
    public function setFoodStamp($foodStamp)
    {
        $this->foodStamp = $foodStamp;
    }

    /**
     * Getter for add support number
     * @return addSupport number for guest
     */
    public function getAddSupport()
    {
        return $this->addSupport;
    }

    /**
     * Setter for add support number
     * @param $addSupport number of guest
     */
    public function setAddSupport($addSupport)
    {
        $this->addSupport = $addSupport;
    }

    /**
     * Getter for if mental disabilities
     * @return mental disabilaties of guest
     */
    public function getMental()
    {
        return $this->mental;
    }

    /**
     * Setter for mental disabilities
     * @param $mental mental disabilities of  guest
     */
    public function setMental($mental)
    {
        $this->mental = $mental;
    }

    /**
     * Getter for physical disabilities
     * @return physical disabilies of guest
     */
    public function getPhysical()
    {
        return $this->physical;
    }

    /**
     * Setter for physical disabilities
     * @param $physical physical disabilities of guest
     */
    public function setPhysical($physical)
    {
        $this->physical = $physical;
    }

    /**
     * Getter for veteran disabilities
     * @return veteran disabilities of guest
     */
    public function getVeteran()
    {
        return $this->veteran;
    }

    /**
     * Setter for veteran disabilities
     * @param $veteran veteran disabilities of guest
     */
    public function setVeteran($veteran)
    {
        $this->veteran = $veteran;
    }

    /**
     * Getter for homeless disabilities
     * @return homeless disabilies of guest
     */
    public function getHomeless()
    {
        return $this->homeless;
    }

    /**
     * Setter for homless disabilities
     * @param $homeless homeless disabilities of guest
     */
    public function setHomeless($homeless)
    {
        $this->homeless = $homeless;
    }

    /**
     * Getter for notes
     * @return notes of guest
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Setter for notes
     * @param $notes notes of guest
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }
}