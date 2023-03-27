<?php
    session_start();

    if(isset($_COOKIE['astatus']) && isset($_SESSION['id']) && isset($_SESSION['pass']))
    { 

        $required = array('changeID','heading','toChange');
        $id_found = false;
        // Loop over field names, make sure each one exists and is not empty
        $error = false;
        foreach($required as $field) 
        {
            if (empty($_POST[$field])) 
            {
                $error = true;
                break;
            }
        }

        if(!$error)
        {
            $id = $_REQUEST['changeID'];
            $heading = $_REQUEST['heading'];
            $new = $_REQUEST['toChange'];
            $a = array();
            
            $file = fopen('../model/managerList.txt','r');
            while(!feof($file))
            {
                $data = fgets($file);
                $user = explode("|",$data);

                if($user[0] == $id)
                {
                    $id_found = true;
                    switch($heading)
                    {
                        case "Name":
                            $newdata = str_replace($user[1],$new,$data);
                            array_push($a,$newdata);
                            break;
                        case "Distribution":
                            $newdata = str_replace($user[3],$new,$data);
                            array_push($a,$newdata);
                            break;
                        case "Phone number":
                            $newdata = str_replace($user[5],$new,$data);
                            array_push($a,$newdata);
                            break;
                        case "Email":
                            $newdata = str_replace($user[6],$new,$data);
                            array_push($a,$newdata);
                            break;
                        case "DOB":
                            $newdata = str_replace($user[7],$new,$data);
                            array_push($a,$newdata);
                            break;
                        case "Experience":
                            $newdata = str_replace($user[8],$new,$data);
                            array_push($a,$newdata);
                            break;
                        case "Education":
                            $newdata = str_replace($user[9],$new,$data);
                            array_push($a,$newdata);
                            break;
                        case "Degree":
                            $newdata = str_replace($user[10],$new,$data);
                            array_push($a,$newdata);
                            break;
                        case "Salary":
                            $newdata = str_replace($user[11],$new,$data)."\r\n";
                            array_push($a,$newdata);
                            break;
                    
                    }
                    
                }
                else
                {
                    array_push($a,$data);

                }
            }
            fclose($file);

            if(!$id_found)
            {
                echo "ID does not exist";
                echo "<br><a href='../view/editSalesManager.php'>Back</a>";
                echo "<br><a href='../view/ahome.php'>Go Home</a>";
            }

            else
            {
                //print_r($a);
                $write = fopen('../model/managerList.txt','w');
                //fwrite($write);
                $updated = '';
                foreach($a as $item)
                {
                    $updated = $updated.$item;
                }
                echo $updated;
                fwrite($write,$updated);
                fclose($write);
                //$_SESSION['pass'] = $npass;
                header('location: ../view/sales_manager.php');
            }
        }
        else
        {
            echo "Please enter all details properly";
            echo "<br><a href='../view/editSalesManager.php'>Back</a>";
            echo "<br><a href='../view/ahome.php'>Go Home</a>";
        }
    }
    else
    {
        echo "Invalid request";
        echo "<br><a href='../view/login.php'>Login</a>";
    }    
?>