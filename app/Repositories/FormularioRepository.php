<?php

namespace App\Repositories;

use App\Entities\Formulario;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Interface FormularioRepository.
 *
 * @package namespace App\Repositories;
 */
interface FormularioRepositoryInterface
{
    public function getAll();
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
}

class FormularioRepository extends BaseRepository implements FormularioRepositoryInterface
{
    protected $formulario;

    public function __construct(Formulario $formulario)
    {
        $this->formulario = $formulario;
    }

     /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoFormulario::class;
    }

    public function getAll()
    {
        return $this->formulario->all();
    }

    public function create(array $data)
    {
        return $this->formulario->create($data);
    }

    public function update(array $data, $id)
    {
        $formulario = $this->formulario->find($id);
        return $formulario->update($data);
    }

    public function delete($id)
    {
        return $this->formulario->destroy($id);
    }
}

