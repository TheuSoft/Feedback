<?php
namespace service;

use dao\mysql\FeedbackDAO;

class FeedbackService extends FeedbackDAO
{
    public function listarFeedback()
    {
        return parent::listar();
    }

    public function inserir($feedback)
    {
        return parent::inserir($feedback);
    }

    public function alterar($feedback)
    {
        return parent::atualizar($feedback);
    }

    public function listarId($id)
    {
        return parent::listarId($id);
    }
}