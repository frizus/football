<?php

/**
 *
 * Class RollScoreFootball
 */
class RollScoreFootball extends Component
{
    /**
     * @var TeamsFootball
     */
    protected $teamsFootball;

    /**
     * @param $c1
     * @param $c2
     * @return array
     */
    public function getScores($c1, $c2)
    {
        $team1 = $this->teamsFootball->getTeam($c1);
        $team2 = $this->teamsFootball->getTeam($c2);

        $sameTeamValidator = new SameTeamValidator();
        if (!$sameTeamValidator->validate($c1, $c2))
        {
            $sameTeamValidator->throwError();
        }

        return [
            $this->getRollScore($team1->getMatchAvgScore($team2)),
            $this->getRollScore($team2->getMatchAvgScore($team1))
        ];
    }

    /**
     * Рассчет случайного числа голов, в том числе на основе мощности команды
     * @param $u
     * @return int
     */
    protected function getRollScore($u)
    {
        $rolledChance = rand() / getrandmax();
        $x = 0;
        $chanceStep = 0;

        while ($rolledChance > $chanceStep)
        {
            // Больше мирового рекорда пусть не забивают
            if ($x <= 31)
            {
                ++$x;
            }
            else
            {
                $x = 0;
                $rolledChance = rand() / getrandmax();
                $chanceStep = 0;
            }

            $chanceI = Math::getPoissonDistribution($u, $x);
            $chanceStep += $chanceI;
        }

        return $x;
    }
}