<?php

namespace App\Http\Controllers;

use App\Services\FormularioService;
use Illuminate\Http\Request;

class FormularioController extends Controller
{
    protected $formularioService;

    public function __construct(FormularioService $formularioService)
    {
        $this->formularioService = $formularioService;
    }

    public function index()
    {
        $formularios = $this->formularioService->getAll();
        return view('formulario.index', compact('formularios'));
    }

    public function create()
    {
        return view('formulario.create');
    }

    public function store(Request $request)
    {
        $data = $request->only(['titulo', 'descricao', 'campo1', 'campo2']);
        $formulario = $this->formularioService->create($data);
        return redirect()->route('formulario.index');
    }

    public function edit($id)
    {
        $formulario = $this->formularioService->getAll($id);
        return view('formulario.edit', compact('formulario'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(['titulo', 'descricao', 'campo1', 'campo2']);
        $formulario = $this->formularioService->update($data, $id);
        return redirect()->route('formulario.index');
    }
}
