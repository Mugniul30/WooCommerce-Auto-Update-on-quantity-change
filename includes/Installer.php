<?php

namespace WC\AU;

class Installer {

    public function add_version(){
        $installed = get_option('wcau_installed');

        if (!$installed) {
            update_option( 'wcau_installed',time());
        }
        update_option( 'wcau_version', WCAU_VERSION);
    }
    
}
