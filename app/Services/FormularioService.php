<?php

namespace App\Services;

use App\Models\Formulario;
use App\Repositories\FormularioRepository;

class FormularioService
{
    protected $formularioRepository;

    public function __construct(FormularioRepository $formularioRepository)
    {
        $this->formularioRepository = $formularioRepository;
    }

    public function getAll()
    {
        return $this->formularioRepository->getAll();
    }

    public function create(array $data)
    {
        return $this->formularioRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->formularioRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->formularioRepository->delete($id);
    }
}
