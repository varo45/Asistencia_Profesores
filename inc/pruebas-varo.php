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
                        <h2>Enviar mensaje a Jefatura</h2>
                    </div>

                    <!-- Login Form -->
                    <form class="login-form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                        <input type="text" name="ID" class="hidden" value="<?php echo $_SESSION['ID']; ?>">
                        <label for="Asunto">Asunto</label></br>
                        <input id="Asunto" type="text" minlength="2" maxlength="50" name="Asunto" class="fadeIn first" placeholder="Asunto" required></br>
                        <label for="Mensaje">Mensaje</label></br>
                        <textarea id="Mensaje" minlength="4" type="text" name="new_pass" class="fadeIn second" placeholder="Escriba aquí su mensaje..." required></textarea></br>
                        <input type="submit" name="mensaje" value="Enviar" class="fadeIn third">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>