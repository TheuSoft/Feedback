<?php
namespace template;

interface ITemplate 
{
    public function render($data = []);
    public function setTitle($title);
    public function getTitle();
    public function addCss($css);
    public function addJs($js);
    public function setLayout($layout);
    public function getLayout();
    public function layout(string $view, $data = []);
}
