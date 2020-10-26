<?php
function register_parent(){
    global $connect;
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "INSERT INTO parents (parent_name, parent_email, parent_password) VALUES('$username','$email','$password')";
        $query = mysqli_query($connect,$sql);
        if(!$query){
            echo " <div class='message'>
                <p>Email ID already exists</p>
            </div>";
        }
        else{
            echo " <div class='message'>
            <p>Your account was created proceed to the login page for login!</p>
        </div>";
        }
}

function parent_login(){
    global $connect;
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM parents WHERE parent_email = '$email'";
            $query = mysqli_query($connect,$sql);
            $row = mysqli_fetch_assoc($query);
            $accountv = false;
            $emailv = $row['parent_email'];
            $passwordv = $row['parent_password'];
            if ($emailv == $email && $passwordv == $password){
                $accountv = true;
            }
         if((mysqli_num_rows($query)>0) and $accountv == true){
             session_start();
            $_SESSION['email'] = $email;
                header("Location:parents.php");
            }
            else{
                echo "<div class='message'>
                <p>Email ID or Password entered is incorrect</p>
            </div>";
            }
}

function register_children(){
    global $connect,$parentemail;
        $parentsql = "SELECT * FROM parents WHERE parent_email = '$parentemail'";
        $parentquery = mysqli_query($connect,$parentsql);
        $rowid = 0;
        if(mysqli_num_rows($parentquery)>0)
        {
            $row = mysqli_fetch_assoc($parentquery);
            $rowid = $row['id'];
        }
        else{
            echo "NO such was found";
        }
        $childname = $_POST['name'];
        $childemail = $_POST['email'];
        $childpassword = $_POST['password'];
        $childamount = $_POST['amount'];
        $childauthorize = $_POST['authorize'];
        $childbudget = $_POST['budget'];
        if (empty($childname)||empty($childemail)||empty($childpassword)||empty($childamount)||empty($childauthorize)||empty($childbudget)){
            echo " <div class='message'>
            <p>Please fill in all the details</p>
        </div>";
        }
        else{
            $childsql = "INSERT INTO children(child_name,child_email,child_password,total_amount,budget,money_authorized,parent_id) VALUES ('$childname','$childemail','$childpassword','$childamount','$childbudget','$childauthorize','$rowid')";
            $childquery = mysqli_query($connect,$childsql);
            if(!$childquery){
                echo  " <div class='message'>
                <p>The account could not be created or the account your trying to create exists</p>
            </div>";
            }
            else{
                " <div class='message'>
                <p>The account was successfully created</p>
            </div>";
            }
        }
        
}

function child_login(){
    global $connect;
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM children WHERE child_email = '$email'";
            $query = mysqli_query($connect,$sql);
            $row = mysqli_fetch_assoc($query);
            $accountv = false;
            $emailv = $row['child_email'];
            $passwordv = $row['child_password'];
            if ($emailv == $email && $passwordv == $password){
                $accountv = true;
            }
         if((mysqli_num_rows($query)>0) and $accountv == true){
             session_start();
                $_SESSION['email'] = $email;
                header("Location:childsession.php");
            }
            else{
                echo "<div class='message'>
                <p>Email ID or Password entered is incorrect</p>
            </div>";
            }
}

function fetch_child_data()
{
    global $connect,$parentemail;
    $parentsql = "SELECT * FROM parents WHERE parent_email = '$parentemail'";
    $parentquery = mysqli_query($connect,$parentsql);
    $rowid = 0;
    if(mysqli_num_rows($parentquery)>0)
    {
        $row1 = mysqli_fetch_assoc($parentquery);
        $rowid = $row1['id'];
    }
    else{
        echo "NO such was found";
    }
    $childsql = "SELECT * FROM children WHERE parent_id = '$rowid'";
    $childfetchquery = mysqli_query($connect,$childsql);
    if(mysqli_num_rows($childfetchquery)>0){
        while($row = mysqli_fetch_assoc($childfetchquery)){
            $childid = $row['id'];
       echo "<tr> <td>".$row['child_name']."</td>";
    echo "<td>".$row['child_email'] ."</td>";
    echo "<td>".$row['total_amount']."</td>";
    echo "<td>".$row['budget']."</td>";
    echo "<td>".$row['money_authorized']."</td>";
    echo "<td><a href='edit.php?id=$childid'>Edit</a></td>";
   echo  "</tr>";
}
}
}

function update_child_details(){
    global $connect,$id;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $authorize = $_POST['authorize'];
    $budget = $_POST['budget'];
    $total = $_POST['total'];
    $previous_total = $_POST['previous_total'];
    $total = $total + $previous_total;

    $usql = "UPDATE children SET child_name='$username',child_email='$email',child_password='$password',money_authorized = '$authorize',budget = '$budget', total_amount='$total'  WHERE id = '$id'";
    $uquery = mysqli_query($connect,$usql);
    if($uquery){
        echo "All the data was updated";
    }
    else{
        echo "The data was not updated";
    }
}

?>