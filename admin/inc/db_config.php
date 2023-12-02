<?php

    $hname = 'localhost';
    $uname = 'root';
    $pass = '';
    $db = 'doancuoiky';

    $con = mysqli_connect($hname,$uname,$pass,$db);

    if(!$con){
        die("lỗi kết nối dữ liệu". mysqli_connect_error());    

    }
    function filteration ($data){
        foreach ($data as $key => $value) {
            $value = trim($value);
            $value = stripslashes($value);      
            $value = strip_tags($value);
            $value = htmlspecialchars($value);
            $data[$key] = $value;
    
        }
        return $data;
        }

        function selectAll($table)
    {
        $con = $GLOBALS['con'];
        $res = mysqli_query($con,"SELECT * FROM $table");
        return $res;
        
    }
    function select($sql, $value, $datatypes)
    {
        $con = $GLOBALS['con'];
        if($stmt =mysqli_prepare($con, $sql))
        {
            mysqli_stmt_bind_param($stmt,$datatypes,...$value);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;

        }
        else{
            mysqli_stmt_close($stmt);
            die("query cannot be executed -select ");

        }
    }
        else{
            die("query cannot be prepare -select ");
        }
    }
    function update($sql, $value, $datatypes)
    {
        $con = $GLOBALS['con'];
        if($stmt =mysqli_prepare($con, $sql))
        {
            mysqli_stmt_bind_param($stmt,$datatypes,...$value);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;

        }
        else{
            mysqli_stmt_close($stmt);
            die("query cannot be executed - update ");

        }
    }
        else{
            die("query cannot be prepare - update ");
        }
    }

    function insert($sql, $value, $datatypes)
    {
        $con = $GLOBALS['con'];
        if($stmt =mysqli_prepare($con, $sql))
        {
            mysqli_stmt_bind_param($stmt,$datatypes,...$value);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;

        }
        else{
            mysqli_stmt_close($stmt);
            die("query cannot be executed - insert ");

        }
    }
        else{
            die("query cannot be prepare - insert ");
        }
    }

    function delete($sql, $value, $datatypes)
    {
        $con = $GLOBALS['con'];
        if($stmt =mysqli_prepare($con, $sql))
        {
            mysqli_stmt_bind_param($stmt,$datatypes,...$value);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;

        }
        else{
            mysqli_stmt_close($stmt);
            die("query cannot be executed - delete ");

        }
    }
        else{
            die("query cannot be prepare - delete ");
        }
    }
    
    
    
?>