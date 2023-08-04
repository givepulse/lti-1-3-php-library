<?php

namespace IMSGlobal\LTI;

interface Database
{
    public function find_registration_by_issuer($iss);

    public function find_registration_by_issuer_client_id($iss, $client_id);

    public function find_registration_by_deployment($iss, $deployment_id);
}

?>