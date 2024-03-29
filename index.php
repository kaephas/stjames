<?php
/**
 * Created by PhpStorm.
 * User: Alex Pavel
 * Date: 3/7/2018
 * Time: 12:25 PM
 */
//Require the autoload file
require_once('vendor/autoload.php');
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Create an instance of the Base Class
$f3 = Base::instance();
$f3->set('ethnicities', array('white', 'black', 'hispanic', 'native', 'asian', 'pacific', 'eskimo','mixed','other' ));
$f3->set('listResources', array('thriftshop','gas','waterbill','energybill','food','dol','other'));
$f3->set('listGenders', array('male','female','other'));

//logout route
$f3->route('GET|POST /logout', function($f3,$params) {
    //unsets the session variables
    unset($_SESSION['username']);
    $f3->reroute('/');
});

//login
$f3->route('GET|POST /', function($f3,$params) {
    $database = new Database();
    //if submitted login form
    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        //checks the database if the credentials are correct
        $user = $database->getUser($username,$password);
        //returns 1 if correct, and nothing if incorrect
        if(!empty($user))
        {
            //sets the session
            $_SESSION['username'] = $username;
            $f3->reroute('/home');
        } else {
            $f3->set('error', 'Incorrect Login');
        }
    }
    $template = new Template();
    echo $template->render('views/login.html');
}
);
//Define a default route(home)
$f3->route('GET /home', function($f3,$params)
{
    //if logged in
    if(empty($_SESSION['username']))
    {
        $f3->reroute('/');
    }
    $database = new Database();
    $guests = $database->getGuests();

    //Date and Phone Format guestinfo
    for($i = 0; $i < count($guests); $i++)
    {
        // date
        $bday=$guests[$i]['birthdate'];
        $validDate = strtotime($bday);
        $guests[$i]['birthdate'] = date('m/d/Y', $validDate); //newdate

        // phone
        if(strlen($guests[$i]['phone']) > 0) {
            $phone = $guests[$i]['phone'];
            $area = substr($phone,0, 3);
            $first = substr($phone, 3, 3);
            $last = substr($phone,-4);
            $guests[$i]['phone'] = "(" . $area . ") " . $first . "-" . $last;
        }

    }

    $f3->set('guests', $guests);
    $needs = $database->getNeeds();
    //Date Format Guest Needs
    for($i = 0; $i < count($needs); $i++)
    {
        $visitDate= $needs[$i]['visitDate'];
        $validDate = strtotime($visitDate);
        $needs[$i]['visitDate'] = date('m/d/Y', $validDate); //newdate
    }

    $f3->set('needs', $needs);
    $households = $database->getHouseholds();
    $f3->set('households', $households);
    $template = new Template();
    echo $template->render('views/home.html');

}
);
//reports
$f3->route('GET|POST /reports', function($f3,$params) {
    //if logged in
    if (empty($_SESSION['username'])) {
        $f3->reroute('/');
    }
    // initialize variable
    $start = date("m-d-Y");
    $end = date("m-d-Y");
    // set to new value when submitting
    if (isset($_POST['submit'])) {
        if (!empty($_POST['start'])) {
            $start = $_POST['start'];
        }
        if (!empty($_POST['end'])) {
            $end = $_POST['end'];
        }
    }
    $f3->set('start', $start);
    $f3->set('end', $end);
    $database = new Database();
    //setters for the hive
    $needs = $database->getNeeds();

    //Date Format
    for ($i = 0; $i < count($needs); $i++) {
        $visitDate = $needs[$i]['visitDate'];
        //
        $validDate = strtotime($visitDate);
        $needs[$i]['visitDate'] = date('m/d/Y', $validDate); //newdate
    }
    $f3->set('needs', $needs);

    $thrift = $database->getThrift($start, $end);
    $f3->set('thrift', $thrift);
    $gas = $database->getGas($start, $end);
    $f3->set('gas', $gas);
    $water = $database->getWater($start, $end);
    $f3->set('water', $water);
    $energy = $database->getEnergy($start, $end);
    $f3->set('energy', $energy);
    $food = $database->getFood($start, $end);
    $f3->set('food', $food);
    $dol = $database->getDol($start, $end);
    $f3->set('dol', $dol);
    $other = $database->getOther($start, $end);
    $f3->set('other', $other);
    $total = $database->getTotal($start, $end);
    $f3->set('total', $total);
    $template = new Template();
    echo $template->render('views/reports.html');


}
);
//newGuest
$f3->route('GET|POST /newGuest', function($f3)
{
    //if logged in
    if(empty($_SESSION['username']))
    {
        $f3->reroute('/');
    }
    // date format change
    $dateToday = date("m/d/Y");
    $f3->set('dateToday',$dateToday);

    if(isset($_POST['submit'])){

        //setting variables
        $firstName = $_POST['first'];
        $lastName = $_POST['last'];
        $birthdate = $_POST['birthdate'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $ethnicity = $_POST['ethnicity'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];
        $mental = $_POST['mental'];
        $physical = $_POST['physical'];
        $veteran = $_POST['veteran'];
        $homeless = $_POST['homeless'];
        $income = $_POST['income'];
        $rent = $_POST['rent'];
        $foodStamp = $_POST['foodStamp'];
        $addSupport = $_POST['addSupport'];
        $license = $_POST['license'];
        $pse = $_POST['pse'];
        $water = $_POST['water'];
        $notes = $_POST['notes'];
        $voucher = $_POST['voucher'];
        $checkNum = $_POST['checkNum'];
        $amount = $_POST['amount'];
        $date = $_POST['date'];
        $resource = $_POST['resource'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];

        // convert phone format
        $phone = str_replace(array("(", ")", " ", "-"), "", $phone);
        $area = substr($phone,0, 3);
        $first = substr($phone, 3, 3);
        $last = substr($phone,-4);
        $phone = "(" . $area . ") " . $first . "-" . $last;

        //set to hive
        $f3->set('firstName', $firstName);
        $f3->set('lastName', $lastName);
        $f3->set('birthdate', $birthdate);
        $f3->set('phone', $phone);
        $f3->set('email', $email);
        $f3->set('ethnicity', $ethnicity);
        $f3->set('street', $street);
        $f3->set('city', $city);
        $f3->set('zip', $zip);
        $f3->set('mental', $mental);
        $f3->set('physical', $physical);
        $f3->set('veteran', $veteran);
        $f3->set('homeless', $homeless);
        $f3->set('income', $income);
        $f3->set('rent', $rent);
        $f3->set('foodStamp', $foodStamp);
        $f3->set('addSupport', $addSupport);
        $f3->set('license', $license);
        $f3->set('pse', $pse);
        $f3->set('water', $water);
        $f3->set('notes', $notes);

        $mainVouch = array();
        for($i = 0; $i < sizeof($voucher);$i++){
            if(!empty($voucher[$i]) || !empty($resource[$i])) {
                $temp = array();
                array_push($temp, $voucher[$i], $checkNum[$i], $amount[$i], $date[$i], $resource[$i]);
                array_push($mainVouch,$temp);
            }
        }

        $mainMem = array();
        for($i = 0; $i < sizeof($name);$i++){
            if(!empty($name[$i])) {
                $temp = array();
                array_push($temp, $name[$i], $age[$i], $gender[$i]);
                array_push($mainMem,$temp);
            }
        }
        $f3->set('vouchers', $mainVouch);
        $f3->set('members', $mainMem);

        include('model/validation.php');
        $isValid = true;

        //validate first Name
        if(!validFirst($firstName)){
            $f3->set('invalidFirstName', "invalid");
            $isValid  = false;
        }
        //validate last name
        if (!validLast($lastName)) {
            $f3->set('invalidLastName', "invalid");
            $isValid = false;
        }
        //validate birthdate
        if(!validBirth($birthdate)){
            $f3->set('invalidBirthdate', "invalid");
            $isValid = false;
        }
        //validate phone number
        if(!validPhone($phone)){
            $f3->set('invalidPhone', "invalid");
            $isValid = false;
        }
        //validate zipcode
        if(!validZip($zip)){
            $f3->set('invalidZip', "invalid");
            $isValid = false;
        }
        //validate monthly income
        if(!validIncome($income)){
            $f3->set('invalidIncome', "invalid");
            $isValid = false;
        }
        //validate monthly rent
        if(!validRent($rent)) {
            $f3->set('invalidRent', "invalid");
        }
        //validate foodstamps
        if(!validfoodstamps($foodStamp)){
            $f3->set('invalidFoodstamps', "invalid");
            $isValid = false;
        }
        //validate addsupport
        if(!validAddSupport($addSupport)){
            $f3->set('invalidAddSupport', "invalid");
            $isValid = false;
        }

        if($isValid){
            $f3->set('formIsSubmited','true');

            //replace values for easier access later
            if($income == null){
                $income = 0;
            }
            if($rent == null){
                $rent = 0;
            }
            if($foodStamp == null){
                $foodStamp = 0;
            }
            if($addSupport == null){
                $addSupport = 0;
            }
            if($homeless == null){
                $homeless = 0;
            }
            if($veteran == null){
                $veteran = 0;
            }
            if($physical == null){
                $physical = 0;
            }
            if($mental == null){
                $mental = 0;
            }

            //setter for the guest object
            $guest = new Guest($firstName,$lastName,$birthdate);

            // strip phone back to all numberic for db
            $phone = str_replace(array("(", ")", " ", "-"), "", $phone);

            //add setters for all variables
            $guest->setPhone($phone);
            $guest->setEmail($email);
            $guest->setEthnicity($ethnicity);
            $guest->setStreet($street);
            $guest->setCity($city);
            $guest->setZip($zip);
            $guest->setMental($mental);
            $guest->setPhysical($physical);
            $guest->setVeteran($veteran);
            $guest->setHomeless($homeless);
            $guest->setIncome($income);
            $guest->setRent($rent);
            $guest->setFoodStamp($foodStamp);
            $guest->setAddSupport($addSupport);
            $guest->setLicense($license);
            $guest->setPse($pse);
            $guest->setWater($water);
            $guest->setNotes($notes);
            $database = new Database();

            //insert the guest into the database
            $database->insertGuest($guest->getfname(),$guest->getlname(),$guest->getBirthdate(),$guest->getPhone(),
                $guest->getEmail(),$guest->getEthnicity(),$guest->getStreet(),$guest->getCity(),$guest->getZip(),
                $guest->getLicense(),$guest->getPse(),$guest->getWater(),$guest->getIncome(),$guest->getRent(),
                $guest->getFoodStamp(),$guest->getAddSupport(),$guest->getMental(),$guest->getPhysical(),
                $guest->getVeteran(),$guest->getHomeless(),$guest->getNotes());

            $lastId = $database->getLastId();
            $f3->set('lastId', $lastId);

            /*
            echo "<pre>";
                var_dump($mainVouch);
            echo "</pre>";
            */

            if(!empty($mainVouch)){
                for($i = 0; $i < sizeof($mainVouch);$i++){
                    $database->insertNeeds($mainVouch[$i][4],$mainVouch[$i][3], $mainVouch[$i][2],$mainVouch[$i][0],$mainVouch[$i][1]);
                }
            }
            if(!empty($mainMem)) {
                for ($i = 0; $i < sizeof($mainMem); $i++) {
                    $database->insertHousehold($mainMem[$i][0], $mainMem[$i][1], $mainMem[$i][2]);
                }
            }
            $f3->reroute('/home');
        }
    }
    $template = new Template();
    echo $template->render('views/newGuest.html');
}
);

//edit guest
$f3->route('GET|POST /@client_id', function($f3,$params) {
    if(empty($_SESSION['username']))
    {
        $f3->reroute('/');
    }
    $id = $params['client_id'];
    $database = new Database();
    $guest = $database->getGuest($id);
    $mainVouch = array();
    $mainMem = array();
    $tempVouch = $database->getUserNeeds($id);
    $tempMem = $database->getUserHousehold($id);



    for($x = 0; $x < sizeof($tempVouch);$x++){
        if(!empty($tempVouch[$x])) {
            $temp = array();
            array_push($temp, $tempVouch[$x]['voucher'], $tempVouch[$x]['checkNum'], $tempVouch[$x]['amount'], $tempVouch[$x]['visitDate'],$tempVouch[$x]['resource']);
            array_push($mainVouch,$temp);
        }
    }

    //sort vouchers by date
    function compareOrder($a, $b)
    {
        return strnatcmp($a[3], $b[3]);
    }
    usort($mainVouch, 'compareOrder');

    for($x = 0; $x < sizeof($tempMem);$x++){
        if(!empty($tempMem[$x])) {
            $temp = array();
            array_push($temp, $tempMem[$x]['name'], $tempMem[$x]['age'], $tempMem[$x]['gender']);
            array_push($mainMem,$temp);
        }
    }

    // convert phone format for display
    $dbPhone = $guest['phone'];
    $area = substr($dbPhone,0, 3);
    $first = substr($dbPhone, 3, 3);
    $last = substr($dbPhone,-4);
    $guest['phone'] = "(" . $area . ") " . $first . "-" . $last;

    $f3->set('firstName', $guest['first']);
    $f3->set('lastName', $guest['last']);
    $f3->set('birthdate', $guest['birthdate']);
    $f3->set('phone', $guest['phone']);
    $f3->set('email', $guest['email']);
    $f3->set('ethnicity', $guest['ethnicity']);
    $f3->set('street', $guest['street']);
    $f3->set('city', $guest['city']);
    $f3->set('zip', $guest['zip']);
    $f3->set('license', $guest['license']);
    $f3->set('pse', $guest['pse']);
    $f3->set('water', $guest['water']);
    $f3->set('income', $guest['income']);
    $f3->set('rent', $guest['rent']);
    $f3->set('foodStamp', $guest['foodStamp']);
    $f3->set('addSupport', $guest['addSupport']);
    $f3->set('mental', $guest['mental']);
    $f3->set('physical', $guest['physical']);
    $f3->set('veteran', $guest['veteran']);
    $f3->set('homeless', $guest['homeless']);
    $f3->set('members', $guest['members']);
    $f3->set('notes', $guest['notes']);
    $f3->set('vouchers', $mainVouch);
    $f3->set('members', $mainMem);

    if (isset($_POST['submit'])) {
        $firstName = $_POST['first'];
        $lastName = $_POST['last'];
        $birthdate = $_POST['birthdate'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $ethnicity = $_POST['ethnicity'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];
        $mental = $_POST['mental'];
        $physical = $_POST['physical'];
        $veteran = $_POST['veteran'];
        $homeless = $_POST['homeless'];
        $income = $_POST['income'];
        $rent = $_POST['rent'];
        $foodStamp = $_POST['foodStamp'];
        $addSupport = $_POST['addSupport'];
        $license = $_POST['license'];
        $pse = $_POST['pse'];
        $water = $_POST['water'];
        $notes = $_POST['notes'];
        $voucher = $_POST['voucher'];
        $checkNum = $_POST['checkNum'];
        $amount = $_POST['amount'];
        $date = $_POST['date'];
        $resource = $_POST['resource'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];

        // convert phone format for display
        $phone = str_replace(array("(", ")", " ", "-"), "", $phone);
        $area = substr($phone,0, 3);
        $first = substr($phone, 3, 3);
        $last = substr($phone,-4);
        $phone = "(" . $area . ") " . $first . "-" . $last;

        $f3->set('firstName', $firstName);
        $f3->set('lastName', $lastName);
        $f3->set('birthdate', $birthdate);
        $f3->set('phone', $phone);
        $f3->set('email', $email);
        $f3->set('ethnicity', $ethnicity);
        $f3->set('street', $street);
        $f3->set('city', $city);
        $f3->set('zip', $zip);
        $f3->set('mental', $mental);
        $f3->set('physical', $physical);
        $f3->set('veteran', $veteran);
        $f3->set('homeless', $homeless);
        $f3->set('income', $income);
        $f3->set('rent', $rent);
        $f3->set('foodStamp', $foodStamp);
        $f3->set('addSupport', $addSupport);
        $f3->set('license', $license);
        $f3->set('pse', $pse);
        $f3->set('water', $water);
        $f3->set('notes', $notes);

        $mainVouch = array();
        for($i = 0; $i < sizeof($voucher); $i++){
            if(!empty($voucher[$i]) || !empty($resource[$i]) ) {
                $temp = array();
                array_push($temp, $voucher[$i], $checkNum[$i], $amount[$i], $date[$i], $resource[$i]);
                array_push($mainVouch, $temp);
            }
        }

        $mainMem = array();
        for($i = 0; $i < sizeof($name); $i++){
            if(!empty($name[$i])) {
                $temp = array();
                array_push($temp, $name[$i], $age[$i], $gender[$i]);
                array_push($mainMem,$temp);
            }
        }
        $f3->set('vouchers', $mainVouch);
        $f3->set('members', $mainMem);
        include('model/validation.php');
        $isValid = true;
        //validate first Name
        if (!validFirst($firstName)) {
            $f3->set('invalidFirstName', "invalid");
            $isValid = false;
        }
        //validate last name
        if (!validLast($lastName)) {
            $f3->set('invalidLastName', "invalid");
            $isValid = false;
        }
        //validate birthdate
        if (!empty($birthdate) && !validBirth($birthdate)) {
            $f3->set('invalidBirthdate', "invalid");
            $isValid = false;
        }
        //validate phone number
        if (!validPhone($phone)) {
            $f3->set('invalidPhone', "invalid");
            $isValid = false;
        }
        //validate zipcode
        if (!validZip($zip)) {
            $f3->set('invalidZip', "invalid");
            $isValid = false;
        }
        //validate monthly income
        if (!validIncome($income)) {
            $f3->set('invalidIncome', "invalid");
            $isValid = false;
        }
        //validate monthly rent
        if (!validRent($rent)) {
            $f3->set('invalidRent', "invalid");
            $isValid = false;
        }
        //validate foodstamps
        if (!validfoodstamps($foodStamp)) {
            $f3->set('invalidFoodstamps', "invalid");
            $isValid = false;
        }
        //validate addsupport
        if (!validAddSupport($addSupport)) {
            $f3->set('invalidAddSupport', "invalid");
            $isValid = false;
        }
        if ($isValid) {
            $f3->set('formIsSubmited','true');
            if($homeless == null){
                $homeless = 0;
            }
            if($veteran == null){
                $veteran = 0;
            }
            if($physical == null){
                $physical = 0;
            }
            if($mental == null){
                $mental = 0;
            }
            $guest = new Guest($firstName,$lastName,$birthdate);
            //add setters for all variables
            // strip phone back to just numbers for database
            $phone = str_replace(array("(", ")", " ", "-"), "", $phone);
            $guest->setPhone($phone);
            $guest->setEmail($email);
            $guest->setEthnicity($ethnicity);
            $guest->setStreet($street);
            $guest->setCity($city);
            $guest->setZip($zip);
            $guest->setMental($mental);
            $guest->setPhysical($physical);
            $guest->setVeteran($veteran);
            $guest->setHomeless($homeless);
            $guest->setIncome($income);
            $guest->setRent($rent);
            $guest->setFoodStamp($foodStamp);
            $guest->setAddSupport($addSupport);
            $guest->setLicense($license);
            $guest->setPse($pse);
            $guest->setWater($water);
            $guest->setNotes($notes);
            $database = new Database();
            $database->editGuest($id,$guest->getfname(),$guest->getlname(),$guest->getBirthdate(),$guest->getPhone(),
                $guest->getEmail(),$guest->getEthnicity(),$guest->getStreet(),$guest->getCity(),$guest->getZip(),
                $guest->getLicense(),$guest->getPse(),$guest->getWater(),$guest->getIncome(),$guest->getRent(),
                $guest->getFoodStamp(),$guest->getAddSupport(),$guest->getMental(),$guest->getPhysical(),
                $guest->getVeteran(),$guest->getHomeless(),$guest->getNotes());

            if(!empty($mainVouch)){
                for($i = 0; $i < sizeof($mainVouch);$i++){
                    $database->editNeeds($id,$mainVouch[$i][4],$mainVouch[$i][3],$mainVouch[$i][2],$mainVouch[$i][0],$mainVouch[$i][1]);

                }
            }
            if(!empty($mainMem)){
                for($i = 0; $i < sizeof($mainMem);$i++){
                    $database->editHousehold($id,$mainMem[$i][0],$mainMem[$i][1],$mainMem[$i][2]);
                }
            }
            $f3->reroute('/home');
        }
    }
    $template = new Template();
    echo $template->render('views/newGuest.html');
}
);
//demographics
$f3->route('GET /demographics', function($f3)
{
    if(empty($_SESSION['username']))
    {
        $f3->reroute('/');
    }
    $database = new Database();
    //call to the database and set to variables
    $ethnicity = $database->getEthnicity();
    $gender = $database->getGender();
    $zips = $database->getZips();
    $disabilities = $database->getDisabilities();
    $veterans = $database->getVeterans();
//
    $f3->set('ethnicity', $ethnicity);
    $f3->set('gender', $gender);
    $f3->set('zips', $zips);
    $f3->set('disabilities', $disabilities);
    $f3->set('veterans', $veterans);
    $template = new Template();
    echo $template->render('views/demographics.html');
}
);

// temporary route to initialize a new user
//$f3->route('GET /newUser', function() {
//    $database = new Database();
//    $password = 'p566Outreach';
//    echo $password;
//    $success = $database->newUser('volunteer', $password);
//    var_dump($success);
//    if($success) {
//        echo 'success';
//    } else {
//        echo 'failure';
//    }
//});

$f3->route('GET|POST /profile', function($f3,$params) {
    if(empty($_SESSION['username']))
    {
        $f3->reroute('/');
    }
    if( $_SESSION['username'] != 'petero') {
        $f3->reroute('/home');
    }
    $database = new Database();
//    $username = $_SESSION['username'];
//    $f3->set("username" , $username);

    if (isset($_POST['changePassword'])) {

        $username = $_POST['username'];
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];
        $user = $database->getUser($username, $currentPassword);

        // if username and password is correct, it will retrieve it from the database
        if(!empty($user)) {
            // if the passwords match
            if ($newPassword == $confirmPassword) {
                if (strlen($newPassword) > 7) {
                    $database->changePassword($username, $newPassword);
                    $f3->set('userUpdate', $username);
                    $f3->set('passChanged', true);
                } else {
                    $f3->set('error', 'Password must be at least 8 characters');
                }
            } else {
                $f3->set('error', 'Passwords do not match');
            }
        } else {
            $f3->set('error', 'Password incorrect');
        }
    }

    $template = new Template();
    echo $template->render('views/profile.html');
}
);
//Run Fat-Free
$f3->run();
