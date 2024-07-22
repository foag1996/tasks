<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Tarea;

class TareaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Gestión de Tareas';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Tarea());

        $grid->column('id', __('Id'));
        $grid->column('titulo', __('Titulo'));
        $grid->column('descripcion', __('Descripcion'));
        $grid->column('fecha_vencimiento', __('Fecha vencimiento'));
        $grid->column('tarea_completada', __('Tarea completada'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        // Agregar filtro unificado
        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();

            // Add a custom filter
            $filter->where(function ($query) {
                $query->where('titulo', 'like', "%{$this->input}%")
                      ->orWhere('descripcion', 'like', "%{$this->input}%");
            }, 'Buscar por título o descripción')->placeholder('Ingrese título o descripción');
        });


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Tarea::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('titulo', __('Titulo'));
        $show->field('descripcion', __('Descripcion'));
        $show->field('fecha_vencimiento', __('Fecha vencimiento'));
        $show->field('tarea_completada', __('Tarea completada'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Tarea());

        $form->text('titulo', __('Titulo'))->rules('required')->placeholder('Ingrese título');
        $form->textarea('descripcion', __('Descripcion'))->rules('required')->placeholder('Ingrese Descripción');
        $form->date('fecha_vencimiento', __('Fecha vencimiento'))->default(date('Y-m-d'))->rules('required');
        $form->switch('tarea_completada', __('Tarea completada'));

        return $form;
    }
}
