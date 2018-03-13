<?php

/**
 * Class TeamFootball
 */
class TeamFootball extends Component
{
    /**
     * @var TeamsFootball
     */
    protected $teamsFootball;

    /**
     * @var TeamFootball
     */
    protected $teamFootball;

    /**
     * Сколько голов команда забьет в матче оппоненту
     * Рассчитывается по формуле: мощность команды * оборона соперника * средняя арифметическая мощности по ЧМ
     * @param TeamFootball $opponent
     * @return float|int
     */
    public function getMatchAvgScore(self $opponent)
    {
        return $this->getTeamStrength($this) * $this->getTeamDefense($opponent) * $this->teamsFootball->avgStrengthTeam;
    }

    /**
     * Мощность команды рассчитывается по формуле: голы / количество сыгранных игр / мощность по ЧМ
     * @param $team
     * @return float|int
     */
    protected function getTeamStrength(self $team)
    {
        return $team->teamFootball['goals']['scored'] / $team->teamFootball['games'] / $this->teamsFootball->avgStrengthTeam;
    }

    /**
     * Оборона команды рассчитывается по формуле: пропущенные / количеству сыгранных игр / оборона по ЧМ
     * @param $team
     * @return float|int
     */
    protected function getTeamDefense(self $team)
    {
        return $team->teamFootball['goals']['skiped'] / $team->teamFootball['games'] / $this->teamsFootball->avgDefenseTeam;
    }
}