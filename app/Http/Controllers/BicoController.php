<?php

namespace App\Http\Controllers;

use App\Bico;
use App\Bomba;
use App\Tanque;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BicoController extends Controller
{
    use SearchTrait;

    protected $fields = array(
        'id' => ['label' => 'ID', 'type' => 'int', 'searchParam' => true],
        'num_bico' => ['label' => 'N. Bico', 'type' => 'int', 'searchParam' => true],
        'descricao_bomba' => 'Bomba',
        'descricao' => ['label' => 'Combustível', 'type' => 'string', 'searchParam' => true],
        'ativo' => ['label' => 'Ativo', 'type' => 'bool']
    );

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {
        if (Auth::user()->canListarBico()) {
            if (isset($request->searchField)) {
                $whereRaw = $this->getWhereField($request, $this->fields);
                $bicos = DB::table('bicos')
                            ->select('bicos.*', 'bombas.descricao_bomba', 'combustiveis.descricao')
                            ->join('tanques', 'tanques.id', 'bicos.tanque_id')
                            ->join('combustiveis', 'combustiveis.id', 'tanques.combustivel_id')
                            ->join('bombas', 'bombas.id', 'bicos.bomba_id')
                            ->whereRaw($whereRaw)
                            ->paginate();
            } else {
                $bicos = DB::table('bicos')
                            ->select('bicos.*', 'bombas.descricao_bomba', 'combustiveis.descricao')
                            ->join('tanques', 'tanques.id', 'bicos.tanque_id')
                            ->join('combustiveis', 'combustiveis.id', 'tanques.combustivel_id')
                            ->join('bombas', 'bombas.id', 'bicos.bomba_id')
                            ->paginate();
            }

            return View('bico.index')->withBicos($bicos)->withFields($this->fields);
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->canCadastrarBico()) {
            return View('bico.create')->withTanques(Tanque::all())->withBombas(Bomba::all());
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->canCadastrarBico()) { 
            $this->validate($request, [
                'num_bico' => 'required|integer|unique:bicos',
                'tanque_id' => 'required|integer|exists:tanques,id',
                'bomba_id' => 'required|integer|exists:bombas,id',
                'encerrante' => 'required|numeric|min:0'
            ]);

            try {
                $bico = new Bico($request->all());

                if ($bico->save()) {
                    Session::flash('success', __('messages.create_success', [
                        'model' => __('models.bico'),
                        'name' => $bico->num_bico
                    ]));
                    return redirect()->action('BicoController@index', $request->query->all() ?? []);
                }
            } catch (\Exception $e) {
                Session::flash('error', __('messages.exception', [
                    'exception' => $e->getMessage()
                ]));
                return redirect()->back()->withInput();
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bico  $bico
     * @return \Illuminate\Http\Response
     */
    public function edit(Bico $bico)
    {
        if (Auth::user()->canAlterarBico()) {
            return View('bico.edit')
                        ->withBico($bico)
                        ->withTanques(Tanque::all())
                        ->withBombas(Bomba::all());
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bico  $bico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bico $bico)
    {
        if (Auth::user()->canAlterarBico()) {
            $this->validate($request, [
                'num_bico' => 'required|integer|unique:bicos,id,'.$bico->id,
                'tanque_id' => 'required|integer|exists:tanques,id',
                'bomba_id' => 'required|integer|exists:bombas,id',
                'encerrante' => 'required|numeric|min:0'
            ]);

            try {
                $bico->fill($request->all());
                /* $bico->num_bico = $request->num_bico;
                $bico->tanque_id = $request->tanque_id;
                $bico->bomba_id = $request->bomba_id;
                $bico->encerrante = $request->encerrante;
                $bico->ativo = $request->ativo; */

                if ($bico->save()) {
                    Session::flash('success', __('messages.update_success', [
                        'model' => __('models.bico'),
                        'name' => $bico->num_bico
                    ]));
                    return redirect()->action('BicoController@index', $request->query->all() ?? []);
                }
            } catch (\Exception $e) {
                Session::flash('error', __('messages.exception', [
                    'exception' => $e->getMessage()
                ]));

                return redirect()->back()->withInput();
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bico  $bico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bico $bico)
    {
        if (Auth::user()->canExcluirBico()) {
            try {
                if ($bico->delete()) {
                    Session::flash('success', __('messages.delete_success', [
                        'model' => __('models.bico'),
                        'name' => $bico->num_bico
                    ]));
                    
                    return redirect()->action('BicoController@index', $request->query->all() ?? []);
                }
            } catch (\Exception $e) {
                switch ($e->getCode()) {
                    case 23000:
                        Session::flash('error', __('messages.fk_exception'));
                        break;
                    default:
                        Session::flash('error', __('messages.exception', [
                            'exception' => $e->getMessage()
                        ]));
                        break;
                }
                return redirect()->action('BicoController@index', $request->query->all() ?? []);
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back()->withInput();
        }
    }

    public function getBicoJson(Request $request) {
        return response()->json(Bico::find($request->id)->with('tanque.combustivel')->first());
    }

    static public function atualizarEncerranteBico($bicoId, $encerrante) {
        try {
            $bico = Bico::find($bicoId);
            $bico->encerrante = $encerrante;
            return $bico->save();

        } catch (\Exception $e) {
            throw new Exception(__('messages.exception',[
                'exception' => $e->getMessage()
            ]));
        }
    }
}
