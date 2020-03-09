<?php

namespace YogaCMS\UI\Http\Controllers;

use Encore\Admin\Controllers\AdminController;
use YogaCMS\UI\Models\Estados\Estado;
use YogaCMS\UI\Models\Cidades\Cidade;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CidadesController extends AdminController
{

    /**
     * Title for current resource.
     *
     */
    protected $title = 'Cidades';

    /**
     * Make a grid builder.
     *
     */
    protected function grid()
    {
        $grid = new Grid(new Cidade());

        $grid->column('id', __('Código'));
        $grid->column('estado.nome', __('Estado'));
        $grid->column('nome', __('Nome'));

        $grid->filter(function($filter) {
            $filter->equal('estado_id', 'Estado')->select(Estado::all()->pluck('nome', 'id'));
            $filter->like('nome', 'Nome');
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     */
    protected function detail($id)
    {
        $show = new Show(Cidade::findOrFail($id));

        $show->field('id', __('Código'));
        $show->estado('Estado', function($estado) {
            $estado->setResource(admin_url('estados'));
            $estado->uf();
            $estado->nome();
            $estado->ddd();
            $estado->ibge();
        });
        $show->field('nome', __('Nome'));
        $show->field('ibge', __('IBGE'));
        $show->field('created_at', __('Criado'));
        $show->field('updated_at', __('Atualizado'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     */
    protected function form()
    {
        $form = new Form(new Cidade());

        $form->select('estado_id', __('Estado'))->options(Estado::all()->pluck('nome', 'id'));
        $form->text('nome', __('Nome'));
        $form->number('ibge', __('IBGE'));

        return $form;
    }
}
