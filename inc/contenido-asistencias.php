<style>
</style>
</head>
<body>
<div class="container" style="margin-top:50px">
<h1>Calendario de asistencias</h1>
<?php
    $m = date('m');
    $Y = date('Y');
    if($m > 12)
    {
        $m = $m % 12;
        if($m == 0)
        {
            $m = 12;
        }
        $Y = $Y +1;
    }
    $d = cal_days_in_month(CAL_GREGORIAN,$m,$Y);
    $start = unixtojd(mktime(0,0,0,$m,1,$Y));
    $array = cal_from_jd($start,CAL_GREGORIAN);
    if($array['monthname'] === 'January')
    {
        $mes = "Enero";
    }
    elseif($array['monthname'] === 'February')
    {
        $mes = "Febrero";
    }
    elseif($array['monthname'] === 'March')
    {
        $mes = "Marzo";
    }
    elseif($array['monthname'] === 'April')
    {
        $mes = "Abril";
    }
    elseif($array['monthname'] === 'May')
    {
        $mes = "Mayo";
    }
    elseif($array['monthname'] === 'June')
    {
        $mes = "Junio";
    }
    elseif($array['monthname'] === 'July')
    {
        $mes = "Julio";
    }
    elseif($array['monthname'] === 'August')
    {
        $mes = "Agosto";
    }
    elseif($array['monthname'] === 'September')
    {
        $mes = "Septiembre";
    }
    elseif($array['monthname'] === 'October')
    {
        $mes = "Octubre";
    }
    elseif($array['monthname'] === 'November')
    {
        $mes = "Noviembre";
    }
    elseif($array['monthname'] === 'December')
    {
        $mes = "Diciembre";
    }
?>
<div class="month">      
  <ul>
    <!--li class="prev">&#10094;</li>
    <li class="next">&#10095;</li-->
    <li>
    <?php
      echo $mes . "<br>
      <span style='font-size:18px'>$Y</span>";
    ?>
    </li>
  </ul>
</div>
<?php
?>
<ul class="weekdays">
  <li>Lunes</li>
  <li>Martes</li>
  <li>Miércoles</li>
  <li>Jueves</li>
  <li>Viernes</li>
  <li>Sábado</li>
  <li>Domingo</li>
</ul>
<ul class="days">  
    <?php
    if($array['dayname'] === 'Monday')
    {
        
    }
    elseif($array['dayname'] === 'Tuesday')
    {
        $prevm = $m-1;
        if($prevm < 1)
        {
            $prevm = 12;
            $tY = $Y-1;
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$tY);
        }
        elseif($prevm > 12)
        {
            $prevm = 12;
            $tY = $Y+1;
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$tY);
        }
        else
        {
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$Y);
        }

        echo "<li class='notmonth-cal'>$prevdate</li>";
    }
    elseif($array['dayname'] === 'Wednesday')
    {
        $prevm = $m-1;
        if($prevm <= 0)
        {
            $prevm = 12;
            $tY = $Y-1;
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$tY);
        }
        elseif($prevm > 12)
        {
            $prevm = 12;
            $tY = $Y+1;
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$tY);
        }
        else
        {
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$Y);
        }
        $resta = 1;
        for($i = $prevdate-$resta; $i <= $prevdate; $i++)
        {
            echo "<li class='notmonth-cal'>$i</li>";
        }
    }
    elseif($array['dayname'] === 'Thursday')
    {
        $prevm = $m-1;
        if($prevm <= 0)
        {
            $prevm = 12;
            $tY = $Y-1;
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$tY);
        }
        elseif($prevm > 12)
        {
            $prevm = 12;
            $tY = $Y+1;
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$tY);
        }
        else
        {
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$Y);
        }
        $resta = 2;
        for($i = $prevdate-$resta; $i <= $prevdate; $i++)
        {
            echo "<li class='notmonth-cal'>$i</li>";
        }
    }
    elseif($array['dayname'] === 'Friday')
    {
        $prevm = $m-1;
        if($prevm <= 0)
        {
            $prevm = 12;
            $tY = $Y-1;
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$tY);
        }
        elseif($prevm > 12)
        {
            $prevm = 12;
            $tY = $Y+1;
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$tY);
        }
        else
        {
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$Y);
        }
        $resta = 3;
        for($i = $prevdate-$resta; $i <= $prevdate; $i++)
        {
            echo "<li class='notmonth-cal'>$i</li>";
        }
    }
    elseif($array['dayname'] === 'Saturday')
    {
        $prevm = $m-1;
        if($prevm <= 0)
        {
            $prevm = 12;
            $tY = $Y-1;
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$tY);
        }
        elseif($prevm > 12)
        {
            $prevm = 12;
            $tY = $Y+1;
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$tY);
        }
        else
        {
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$Y);
        }
        $resta = 4;
        for($i = $prevdate-$resta; $i <= $prevdate; $i++)
        {
            echo "<li class='notmonth-cal'>$i</li>";
        }
    }
    elseif($array['dayname'] === 'Sunday')
    {
        $prevm = $m-1;
        if($prevm <= 0)
        {
            $prevm = 12;
            $tY = $Y-1;
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$tY);
        }
        elseif($prevm > 12)
        {
            $prevm = 12;
            $tY = $Y+1;
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$tY);
        }
        else
        {
            $prevdate = cal_days_in_month(CAL_GREGORIAN,$prevm,$Y);
        }
        $resta = 5;
        for($i = $prevdate-$resta; $i <= $prevdate; $i++)
        {
            echo "<li class='notmonth-cal'>$i</li>";
        }
    }
    for($i = 1; $i <= $d; $i++)
    {
        $diasemana = unixtojd(mktime(0,0,0,$m,$i,$Y));
        $dateinfo = cal_from_jd($diasemana,CAL_GREGORIAN);
        if($i == $_GET['d'] && $m == $_GET['m'] && $Y == $_GET['Y'])
        {
            echo "<li class='active-cal'>$i</li>";
        }
        else
        {
            if($dateinfo['dayname'] === 'Saturday' || $dateinfo['dayname'] === 'Sunday')
            {
                echo "<li class='weekend-cal'>$i</li>";
            }
            else
            {
                echo "<li>$i</li>";
            }
        }
    }
    ?>
</ul>
</div>