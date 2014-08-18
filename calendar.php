<?php
//This gets today's date
date_default_timezone_set('Europe/Sofia');

$date =time () ;

//This puts the day, month, and year in seperate variables

$day = date('j', $date) ;

$month =date('m', $date) ;

$year = date('Y', $date) ;
if($_POST){

    if($_POST['month']==null){

        $month =date('m', $date) ;

    }else{

        $month = $_POST['month'];

    }



}

// Set starting dates for every shift  
if($_POST){
    switch($_POST['shift']){
        case 1:
            $nameOfShift = "A";
            $start_date = '';
            $start_date1= '';
            $start_nightShift ='';
            $start_nightShift1='';
            break;
        case 2:
            $nameOfShift = "Б";
            $start_date = '';
            $start_date1= '';
            $start_nightShift ='';
            $start_nightShift1='';
            break;
        case 3:
            $nameOfShift = "В";
            $start_date = '';
            $start_date1= '';
            $start_nightShift ='';
            $start_nightShift1='';
            break;
        case 4:
            $nameOfShift = "Г";
            $start_date = '';
            $start_date1= '';
            $start_nightShift ='';
            $start_nightShift1='';
            break;

    }
    //Enter the dafault value for first day shift in the the year in this format '2014-01-01'
}else{
    $start_date = ''; 
    $start_date1 = ''; 
    $start_nightShift='';
    $start_nightShift1=''; 
}

$allDayShifts = array();
//Day shifts count

$end_date = '2014-12-31';



while (strtotime($start_date) < strtotime($end_date)) {

    array_push($allDayShifts,$start_date);
    //echo "$start_date"."<br/>";
    $start_date = date ("Y-m-j", strtotime("+8 day", strtotime($start_date)));


}

$end_date = '2014-12-31';
while (strtotime($start_date1) < strtotime($end_date)) {

    array_push($allDayShifts,$start_date1);
    //echo "$start_date"."<br/>";
    $start_date1 = date ("Y-m-j", strtotime("+8 day", strtotime($start_date1)));


}
//Night shifts
$allNightShifts = array();

$last_nightShift='2014-12-31';

while(strtotime($start_nightShift)<=strtotime($last_nightShift)){
    array_push($allNightShifts,$start_nightShift);
    $start_nightShift=date("Y-m-j",strtotime("+8 day", strtotime($start_nightShift)));
}

$last_nightShift='2014-12-31';

while(strtotime($start_nightShift1)<=strtotime($last_nightShift)){
    array_push($allNightShifts,$start_nightShift1);
    $start_nightShift1=date("Y-m-j",strtotime("+8 day", strtotime($start_nightShift1)));
}

$allNightShifts=array_fill_keys($allNightShifts,'firstNightShift');
$allDayShifts = array_fill_keys($allDayShifts,'firstDayShift');



//Here we generate the first day of the month

$first_day = mktime(0,0,0,$month, 1, $year) ;



//This gets us the month name

$title = date('F', $first_day) ;

switch($title){
    case "January": $title="Януари"; break;

    case "February": $title="Февруари"; break;

    case "March": $title="Март"; break;

    case "April": $title="Април"; break;

    case "May": $title="Май"; break;

    case "June": $title="Юни"; break;

    case "July": $title="Юли"; break;

    case "August": $title="Август"; break;

    case "September": $title="Септември"; break;

    case "October": $title="Октомври"; break;

    case "November": $title="Ноември"; break;

    case "December": $title="Декември"; break;
}

//Here we find out what day of the week the first day of the month falls on
$day_of_week = date('D', $first_day) ;



//Once we know what day of the week it falls on, we know how many blank days occure before it. If the first day of the week is a Sunday then it would be zero

switch($day_of_week){

    case "Mon": $blank = 0; break;

    case "Tue": $blank = 1; break;

    case "Wed": $blank = 2; break;

    case "Thu": $blank = 3; break;

    case "Fri": $blank = 4; break;

    case "Sat": $blank = 5; break;

    case "Sun": $blank = 6; break;


}



//We then determine how many days are in the current month

$days_in_month = cal_days_in_month(0, $month, $year) ;

//Here we start building the table heads

echo "<table>";

echo "<tr><th colspan=7> $title $year </th></tr>";

echo "<tr>
        <td>Понеделник</td>

        <td>Вторник</td>

        <td>Сряда</td>

        <td>Четвъртък</td>

        <td>Петък</td>

        <td>Събота</td>

        <td>Неделя</td>
      </tr>";



//This counts the days in the week, up to 7

$day_count = 01;



echo "<tr>";

//first we take care of those blank days

while ( $blank > 0 )

{

    echo "<td> </td>";

    $blank = $blank-1;

    $day_count++;

}

//Sets the first day of the month to 1

$day_num = 1;



//Count up the days, untill we've done all of them in the month

$today = date('Y',$date).'-'.date('m',$date).'-'.date('j',$date);

while ( $day_num <= $days_in_month )

{   //Make variable witch will search in array of all day shifts


    $calendarDay = '2014'.'-'."$month".'-'.date($day_num);


    if(array_key_exists($calendarDay,$allDayShifts)){

        if($calendarDay==$today){

            echo "<td class='dayShift' id='today'>$day_num</td>";

        }else{

        echo "<td class='dayShift'> $day_num </td>";

        }
    }else if(array_key_exists($calendarDay='2014'.'-'."$month".'-'.(date($day_num)),$allNightShifts)){

        if($calendarDay==$today){

            echo "<td class='nightShift' id='today'>$day_num</td>";

        }else{

            echo "<td class='nightShift'>$day_num </td>";
        }
    }else if($calendarDay==$today){

        echo "<td id='today'>$day_num</td>";

    }else{

    echo "<td> $day_num </td>";

    }




    $day_num++;

    $day_count++;



    //Make sure we start a new row every week

    if ($day_count > 7)

    {

        echo "</tr><tr>";

        $day_count = 1;

    }

}

//Finaly we finish out the table with some blank details if needed

while ( $day_count >1 && $day_count <=7 )

{

    echo "<td> </td>";

    $day_count++;

}


echo "</tr>";
echo'<tfoot><tr>';

include'form.php';

echo'</tfoot></tr></table>';









