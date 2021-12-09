<?php

namespace App\Http\Controllers;

use App\Repositories\HeroRepository;
use App\Repositories\HeroesTeamsRepository;
use App\Repositories\heroesPowersRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class HeroController extends Controller
{
    /**
     * @var HeroRepository
     */
    protected $heroRepository;
    protected $heroesTeamsRepository;
    protected $heroesPowersRepository;

    /**
     * HeroController Constructor
     *
     * @param HeroRepository $heroRepository
     * @param HeroesTeamsRepository $heroesTeamsRepository
     * @param HeroesPowersRepository $heroesPowersRepository
     */
    public function __construct(
        HeroRepository $heroRepository,
        HeroesTeamsRepository $heroesTeamsRepository,
        HeroesPowersRepository $heroesPowersRepository
    )
    {
        $this->heroRepository = $heroRepository;
        $this->heroesTeamsRepository = $heroesTeamsRepository;
        $this->heroesPowersRepository = $heroesPowersRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $result = ['status' => 200];

        $search_param = \request()->get('search');

        try {
            if($search_param) {
                $result['data'] = $this->heroRepository->search($search_param);
            }
            else {
                $result['data'] = $this->heroRepository->getAll();
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'publisher',
            'real_name',
            'hero_name',
            'appearance_at',
            'powers',
            'teams',
        ]);

        $validator = Validator::make($data, [
            'real_name' => 'required',
        ]);

        $result = ['status' => 200];

        try {

            if ($validator->fails()) {
                throw new InvalidArgumentException($validator->errors()->first());
            }

            $result['data'] = $this->heroRepository->save($data);
            $result['teams']['data'] = $this->heroesTeamsRepository->save($data, $result['data']->id);
            $result['powers']['data'] = $this->heroesPowersRepository->save($data, $result['data']->id);

        } catch (Exception $e) {

            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  id
     * @return Response
     */
    public function show($id)
    {
        $result = ['status' => 200];

        try {

            $result['data'] = $this->heroRepository->getById($id);
            $result['teams']['data'] = $this->heroesTeamsRepository->getByHeroId($id);
            $result['powers']['data'] = $this->heroesPowersRepository->getByHeroId($id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     *
     * Update
     *
     * @param Request $request
     * @param id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'publisher',
            'real_name',
            'hero_name',
            'appearance_at',
            'powers',
            'teams',
        ]);

        $validator = Validator::make($data, [
            'real_name' => 'required',
        ]);

        $result = ['status' => 200];

        DB::beginTransaction();
        try {

            if ($validator->fails()) {
                throw new InvalidArgumentException($validator->errors()->first());
            }

            $result['data'] = $this->heroRepository->update($data, $id);
            $result['teams']['data'] = $this->heroesTeamsRepository->update($data, $id);
            $result['powers']['data'] = $this->heroesPowersRepository->update($data, $id);

            DB::commit();

        } catch (Exception $e) {

            DB::rollback();

            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = ['status' => 200];

        DB::beginTransaction();

        try {

            $result['data'] = $this->heroRepository->delete($id);
            $result['data'] = $this->heroesTeamsRepository->deleteByHero($id);
            $result['data'] = $this->heroesPowersRepository->deleteByHero($id);

            DB::commit();

        } catch (Exception $e) {

            DB::rollback();

            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
}
