<?php

/**
 * Class Football
 */
class Football extends Component
{
    /**
     * @var TeamsFootball
     */
    protected $teamsFootball;

    /**
     * Football constructor.
     * @param array $config
     * @param $dataPath
     */
    public function __construct(array $config = [], $dataPath)
    {
        $this->teamsFootball = new TeamsFootball([], $dataPath);
    }

    /**
     * @param $c1
     * @param $c2
     * @return array
     */
    public function getRollScore($c1, $c2)
    {
        $rollScoreFootball = new RollScoreFootball(['teamsFootball' => $this->teamsFootball]);
        return $rollScoreFootball->getScores($c1, $c2);
    }
}