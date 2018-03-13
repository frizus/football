<?php

/**
 * Class TeamsFootball
 */
class TeamsFootball extends Component
{
    /**
     * @var float
     */
    public $avgStrengthTeam;

    /**
     * @var float
     */
    public $avgDefenseTeam;

    /**
     * @var array[]
     */
    public $data;

    /**
     * TeamsFootball constructor.
     * @param array $config
     * @param $dataPath
     * @throws Exception
     */
    public function __construct(array $config = [], $dataPath)
    {
        parent::__construct($config);

        $this->readData($dataPath);
        $this->calculateMeta();
    }

    /**
     * @param $index
     * @return TeamFootball
     * @throws Exception
     */
    public function getTeam($index)
    {
        $footballValidator = new FootballValidator(['teamsFootball' => $this]);
        if (!$footballValidator->validate($index)) {
            $footballValidator->throwError();
        }

        return new TeamFootball([
            'teamsFootball' => $this,
            'teamFootball' => $this->data[$index],
        ]);
    }

    /**
     * @return int
     */
    public function getMaxTeamNumber()
    {
        return count($this->data) - 1;
    }

    /**
     * @param $dataPath
     * @throws Exception
     */
    protected function readData($dataPath)
    {
        $dataValidator = new DataValidator(['file' => $dataPath]);
        if (!$dataValidator->isFileExists())
        {
            $dataValidator->throwError();
        }

        require $dataPath;
        if (!$dataValidator->validate(@$data))
        {
            $dataValidator->throwError();
        }

        $this->data = $data;
    }

    /**
     * Рассчет мощности и обороны по ЧМ
     * Рассчитываются как среднее арифметическое множества, состоящего из выражения:
     * количество голов или пропущенных / количество сыгранных игр
     * @throws Exception
     */
    protected function calculateMeta()
    {
        $this->avgStrengthTeam = 0;
        $this->avgDefenseTeam = 0;

        try
        {
            foreach($this->data as $struct)
            {
                if ($struct['games'] == 0)
                {
                    throw new Exception();
                }
                $this->avgStrengthTeam += $struct['goals']['scored'] / $struct['games'];
                $this->avgDefenseTeam += $struct['goals']['skiped'] / $struct['games'];
            }

            $count = count($this->data);
            if ($count == 0)
            {
                throw new Exception();
            }
            $this->avgStrengthTeam /= $count;
            $this->avgDefenseTeam /= $count;
        }
        catch (Exception $e)
        {
            $validator = new Validator();
            $validator->addMessage('Нужны сыгранные игры футбольных команд.');
            $validator->throwError();
        }
    }
}