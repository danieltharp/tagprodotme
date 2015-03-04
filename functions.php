<?php function callHeader($title) {}

function time_since($since) {
    $chunks = array(
        array(31536000, 'year'),
        array(2592000, 'month'),
        array(604800, 'week'),
        array(86400 , 'day'),
        array(3600 , 'hour'),
        array(60 , 'minute'),
        array(1 , 'second')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
}

function killpage($error) {
	echo $error;
	include('footer.php');
	die();
}

class elo
{
    //protected $kFactor;

    const P1WIN = -1;
    const DRAW  = 0;
    const P2WIN = 1;

    /**
     * Calculate p1 and p2 new Elos
     *
     * @param float $p1Elo
     * @param float $p2Elo
     * @param int   $win Game result (-1: p1 win, 0: draw, +1: p2 win)
     * @return array newP1Elo, newP2Elo
     */
    public function calculate($p1Elo, $p2Elo, $win, $kfactor)
    {
        $newP1Elo = $this->calculatePlayerElo($p1Elo, $p2Elo, -$win, $kfactor);
        //$newP2Elo = $this->calculatePlayerElo($p2Elo, $p1Elo, $win);
		if (($newP1Elo < 100) && ($p1Elo > 200)) { return 0; } else if (($newP1Elo < 100) && ($p1Elo <= 200)) { $newP1Elo = 100; }
		else {
        return round($newP1Elo); }
    }

    protected function calculatePlayerElo($pElo, $oElo, $win, $kfactor)
    {

        $score    = $this->calculateScore($win);
        $expected = $this->calculateExpected($pElo, $oElo);

        return $pElo + $kfactor * ($score - $expected);
    }

    protected function calculateScore($win)
    {
        return (1+$win)/2;
    }

    protected function calculateExpected($pElo, $oElo)
    {
        return 1/(1+pow(10, (($oElo-$pElo)/400)));
    }
}

function multipleOf($divisor,$gameno) {
	if ($gameno % $divisor == 0) { return TRUE; }
	else { return FALSE; }
}
 function PCTofZ($x)
{
  $b1 =  0.319381530;
  $b2 = -0.356563782;
  $b3 =  1.781477937;
  $b4 = -1.821255978;
  $b5 =  1.330274429;
  $p  =  0.2316419;
  $c  =  0.39894228;

  if($x >= 0.0) {
      $t = 1.0 / ( 1.0 + $p * $x );
      $total = (1.0 - $c * exp( -$x * $x / 2.0 ) * $t *
      ( $t *( $t * ( $t * ( $t * $b5 + $b4 ) + $b3 ) + $b2 ) + $b1 ));
	  $total = round($total*100,2);
	  return $total;
  }
  else {
      $t = 1.0 / ( 1.0 - $p * $x );
      $total = ( $c * exp( -$x * $x / 2.0 ) * $t *
      ( $t *( $t * ( $t * ( $t * $b5 + $b4 ) + $b3 ) + $b2 ) + $b1 ));
	  $total = round($total*100,2);
	  return $total;
    }
	
}

function sec2hms ($sec, $padHours = false) 
  {
    $hms = "";

    $hours = intval(intval($sec) / 3600); 

    $hms .= ($padHours) 
          ? str_pad($hours, 2, "0", STR_PAD_LEFT). ":"
          : $hours. ":";
    
    $minutes = intval(($sec / 60) % 60); 

    $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ":";

    $seconds = intval($sec % 60); 

    $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

    return $hms;
  }

 ?>