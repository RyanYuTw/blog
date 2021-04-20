<?php

namespace App\Admin\Controllers;

use App\Models\Mail;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MailController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Mail';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Mail());

        $grid->actions(function ($actions) {
            $actions->disableView();
        });

        $grid->column('id', '編號');
        $grid->column('service_code', '服務對應碼');
        $grid->column('from_name', '寄件人');
        $grid->column('from_mail', '寄件人電郵');
        $grid->column('to_name', '收件人');
        $grid->column('to_mail', '收件人電郵');
        $grid->column('subject', '主旨');
        $grid->column('body', '內容');
        $grid->column('send_status', '發送狀態')->display(function ($send_status) {
            $message = '';
            switch ($send_status) {
                case 1:
                    $message = '發送成功';
                    break;
                case -1:
                    $message = '發送失敗';
                    break;
                default:
                    $message = '尚未發送';
            }
            return $message;
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
        $show = new Show(Mail::findOrFail($id));

        $show->field('id', '編號');
        $show->field('service_code', '服務對應碼');
        $show->field('from_name', '寄件人');
        $show->field('from_mail', '寄件人電郵');
        $show->field('to_name', '收件人');
        $show->field('to_mail', '收件人電郵');
        $show->field('subject', '主旨');
        $show->field('body', '內容');
        $show->field('send_status', '發送狀態');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Mail());

        $form->tools(function (Form\Tools $tools) {
            $tools->disableList();
        });

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        $form->text('service_code', '服務對應碼');
        $form->text('from_name', '寄件人');
        $form->email('from_mail', '寄件人電郵');
        $form->text('to_name', '收件人');
        $form->email('to_mail', '收件人電郵');
        $form->text('subject', '主旨');
        $form->textarea('body', '內容');

        return $form;
    }
}
