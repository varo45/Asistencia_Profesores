<?php

?>
<div class="container" style="margin-top:50px">
    <div class="row">
        <div class="col-xs-12">
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <!-- Tabs Titles -->

                    <!-- Icon -->
                    <div class="fadeIn first">
                        <h2>Enviar mensaje a: </h2>
                    </div>

                    <!-- Login Form -->
                    <form class="login-form" action="index.php?ACTION=enviar_mensaje" method="post">
                        <input type="text" name="ID" class="hidden" value="<?php echo $_SESSION['ID']; ?>">
                        <?php
                            include_once($dirs['inc'] . 'select_profesores.php');
                        ?>
                        </br></br>
                        <label for="Asunto">Asunto</label></br>
                        <input id="Asunto" type="text" minlength="2" maxlength="50" name="Asunto" class="fadeIn first" placeholder="Asunto" required></br>
                        <label for="Mensaje">Mensaje</label></br>
                        <textarea id="Mensaje" minlength="4" type="text" name="Mensaje" class="fadeIn second" placeholder="Escriba aquí su mensaje..." required></textarea></br>
                        <input type="submit" name="enviar_mensaje" value="Enviar" class="fadeIn third">
                    </form>
                        <a href="index.php?ACTION=listar_mensajes"><input  type="submit" name="listar_mensajes" value="Listar Mensajes" class="fadeIn third"></a>
                </div>
            </div>
        </div>
    </div>
</div>