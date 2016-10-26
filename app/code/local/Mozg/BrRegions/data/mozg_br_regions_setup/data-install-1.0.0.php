<?php
/**
 * Copyright © 2016 Mozg. All rights reserved.
 * See LICENSE.txt for license details.
 */

$this->startSetup();

/*************************************************************************
 * Support of federal units of Brazil with 27 states
 *************************************************************************/

$tabela = $this->getTable('directory/country_region'); //pega o nome da tabela que contem os estados no magento
$sqlTeste = "SELECT * FROM {$tabela} WHERE code = 'AC' and country_id = 'BR'"; //faz uma busca pelo id do priemiro estado brasileiro que foi cadastrado no passo anterior
$connectionTeste = $this->getConnection('core_read');
$estadoTeste = $connectionTeste->fetchAll($sqlTeste);

// Antes de inserir os estados, testa para ver se existe o estado AC para nao inserir o cadastro dos estados 2x
if(  @$estadoTeste[0]['code'] != "AC"  ){

    // /app/code/core/Mage/Directory/data/directory_setup/data-install-1.6.0.0.php

    /**
     * Fill table directory/country_region
     * Fill table directory/country_region_name for en_US locale
     */
    $data = array(
     //support of federal units of Brazil with 27 states
        array('BR', 'AC', 'Acre'),
        array('BR', 'AL', 'Alagoas'),
        array('BR', 'AP', 'Amapá'),
        array('BR', 'AM', 'Amazonas'),
        array('BR', 'BA', 'Bahia'),
        array('BR', 'CE', 'Ceará'),
        array('BR', 'ES', 'Espírito Santo'),
        array('BR', 'GO', 'Goiás'),
        array('BR', 'MA', 'Maranhão'),
        array('BR', 'MT', 'Mato Grosso'),
        array('BR', 'MS', 'Mato Grosso do Sul'),
        array('BR', 'MG', 'Minas Gerais'),
        array('BR', 'PA', 'Pará'),
        array('BR', 'PB', 'Paraíba'),
        array('BR', 'PR', 'Paraná'),
        array('BR', 'PE', 'Pernambuco'),
        array('BR', 'PI', 'Piauí'),
        array('BR', 'RJ', 'Rio de Janeiro'),
        array('BR', 'RN', 'Rio Grande do Norte'),
        array('BR', 'RS', 'Rio Grande do Sul'),
        array('BR', 'RO', 'Rondônia'),
        array('BR', 'RR', 'Roraima'),
        array('BR', 'SC', 'Santa Catarina'),
        array('BR', 'SP', 'São Paulo'),
        array('BR', 'SE', 'Sergipe'),
        array('BR', 'TO', 'Tocantins'),
        array('BR', 'DF', 'Distrito Federal')
        //support of federal units of Brazil with 27 states
    );

    foreach ($data as $row) {
        $bind = array(
            'country_id'    => $row[0],
            'code'          => $row[1],
            'default_name'  => $row[2],
        );
        $this->getConnection()->insert($this->getTable('directory/country_region'), $bind);
        $regionId = $this->getConnection()->lastInsertId($this->getTable('directory/country_region'));

        $bind = array(
            'locale'    => 'pt_BR',
            'region_id' => $regionId,
            'name'      => $row[2]
        );
        $this->getConnection()->insert($this->getTable('directory/country_region_name'), $bind);
    }

    // /app/code/core/Mage/Directory/data/directory_setup/data-install-1.6.0.0.php

}

/*************************************************************************
 * Support of federal units of Brazil with 27 states
 *************************************************************************/

$this->endSetup();
