<?php

    //Start session
    session_start();

    //Flash message helper
    //Example flash("register_success", "You are now registered");
    //Display In View echo flash("register_success", "You are now registered");
    /*
     * $class_attr = alert alert-success come from bootstrap
     */
    function flash($name = "", $msg = "", $class_attr = "alert alert-success"){

        if (!empty($name)){

            if (!empty($msg) && empty($_SESSION[$name])){

                if (!empty($_SESSION[$name])){

                    unset($_SESSION[$name]);

                }

                if (!empty($_SESSION[$name . "_class_attr"])){

                    unset($_SESSION[$name . "_class_attr"]);

                }

                $_SESSION[$name] = $msg;
                $_SESSION[$name . "_class_attr"] = $class_attr;

            }elseif(empty($msg) && !empty($_SESSION[$name])){

              $class_attr = !empty($_SESSION[$name . "_class_attr"]) ? $_SESSION[$name . "_class_attr"] : "";

              echo "<div class='" .$class_attr. "' id='msg_flash'>" .$_SESSION[$name]. "</div>";

              unset($_SESSION[$name]);
              unset($_SESSION[$name . "_class_attr"]);

            }

        }

    }