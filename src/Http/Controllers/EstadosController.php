<?php

namespace YogaCMS\UI\Http\Controllers;

use Encore\Admin\Controllers\AdminController;
use YogaCMS\UI\Models\Estados\Estado;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EstadosController extends AdminController
{

    /**
     * Title for current resource.
     *
     */
    protected $title = 'Estados';

    /**
     * Make a grid builder.
     *
     */
    protected function grid()
    {
        $grid = new Grid(new Estado());

        $grid->column('id', __('Código'));
        $grid->column('uf', __('UF'));
        $grid->column('nome', __('Nome'));
        $grid->column('ibge', __('IBGE'));
        $grid->column('ddd', __('DDD'));

        $grid->filter(function($filter) {
            $filter->like('nome', 'Nome');
            $filter->like('uf', 'UF');
            $filter->like('ibge', 'IBGE');
            $filter->like('ddd', 'DDD');
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     */
    protected function detail($id)
    {
        $show = new Show(Estado::findOrFail($id));

        $show->field('id', __('Código'));
        $show->field('nome', __('Nome'));
        $show->field('uf', __('UF'));
        $show->field('ibge', __('IBGE'));
        $show->field('ddd', __('DDD'));
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
        $form = new Form(new Estado());

        $form->text('nome', __('Nome'));
        $form->text('uf', __('UF'));
        $form->number('ibge', __('IBGE'));
        $form->text('ddd', __('DDD'));

        return $form;
    }
}
