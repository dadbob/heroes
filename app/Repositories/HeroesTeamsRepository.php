<?php

namespace App\Repositories;

use App\HeroesTeams;
use Exception;
use Illuminate\Support\Facades\DB;

class HeroesTeamsRepository
{
    /**
     * @var HeroesTeams
     */
    protected $heroesTeam;

    /**
     * HeroesTeamsRepository constructor.
     *
     * @param HeroesTeams $heroesTeam
     */
    public function __construct(HeroesTeams $heroesTeam)
    {
        $this->heroesTeam = $heroesTeam;
    }

    /**
     * Get all heroesTeams.
     *
     * @return HeroesTeams $heroesTeam
     */
    public function getAll()
    {
        return $this->heroesTeam
            ->get();
    }

    /**
     * Get heroesTeam by id
     *
     * @param $hero_id
     * @return mixed
     */
    public function getByHeroId($hero_id)
    {
        return $this->heroesTeam
            ->where('hero_id', '=', $hero_id)
            ->get('team_id as id');
    }

    /**
     * Save Teams
     *
     * @param $data
     * @param $hero_id
     * @return HeroesTeams
     */
    public function save($data, $hero_id)
    {
        if(!empty($data['teams']))
        {
            foreach ($data['teams']['data'] as $team)
            {
                $heroesTeam = new $this->heroesTeam;

                $heroesTeam->forceFill([
                    'hero_id' => $hero_id,
                    'team_id' => $team['id'],
                ])->save();
            }

            return $this->heroesTeam->where('hero_id','=',$hero_id)->get('team_id as id');

        }

    }

    /**
     * Update Teams
     *
     * @param $data
     * @return HeroesTeams
     * @throws Exception
     */
    public function update($data, $hero_id)
    {
        if(!empty($data['teams']) && !empty($hero_id)) {

            DB::beginTransaction();
            try {

                $this->heroesTeam->where('hero_id','=',$hero_id)->delete();

                foreach ($data['teams']['data'] as $team)
                {
                    $heroesTeam = new $this->heroesTeam;

                    $heroesTeam->forceFill([
                        'hero_id' => $hero_id,
                        'team_id' => $team['id'],
                    ])->save();
                }

                DB::commit();

                return $this->heroesTeam->where('hero_id','=',$hero_id)->get('team_id as id');

            } catch (Exception $e) {
                DB::rollback();
                throw $e;
            }
        }
    }

    public function deleteByHero($hero_id)
    {
        if($hero_id) {
            $this->heroesTeam->where('hero_id', '=', $hero_id)->delete();
        }
    }

    /**
     * Update Teams
     *
     * @param $data
     * @return HeroesTeams
     */
    public function delete($id)
    {

        $heroesTeam = $this->heroesTeam->find($id);
        $heroesTeam->delete();

        return $heroesTeam;
    }

}
