<?php
interface ITemplate {
    public function header($titulo);
    public function footer();
    public function render($view, $dados = []);
}
?>
