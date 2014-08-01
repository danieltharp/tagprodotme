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
 ?>