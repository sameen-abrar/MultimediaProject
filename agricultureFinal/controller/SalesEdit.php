<?php
    session_start();
    require_once('../model/salesModel.php');

    $data = $_POST['data'];
    $dataarray = json_decode($data);

    // echo $data;
    if(isset($_COOKIE['astatus']) && isset($_SESSION['id']) && isset($_SESSION['pass']))
    { 

        // $required = array('changeID','heading','toChange');
        // $id_found = false;
        // Loop over field names, make sure each one exists and is not empty
        $error = false;
        foreach($dataarray as $field) 
        {
            if (empty($field)) 
            {
                $error = true;
                break;
            }
        }

        if(!$error)
        {
            $userupdate = updateData($dataarray);

        }
        else
        {
            echo "Please enter all details properly";
            echo "<br><a href='../view/sales_manager.php'>Back</a>";
            echo "<br><a href='../view/ahome.php'>Go Home</a>";
        }
    }
    else
    {
        echo "Invalid request";
        echo "<br><a href='../view/login.php'>Login</a>";
    }    
?>