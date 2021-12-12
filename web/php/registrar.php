<?php

//Datos Usuario
$name =  $_POST['Nombre'];
$passwd = $_POST['Contraseña'];
$uidnumber = strlen($name)+strlen($passwd)+rand(10,1000);

// Datos de acceso al servidor LDAP
$host = "192.168.2.222";
$port = "389";
$dnbind = "cn=admin,dc=botellamunoz,dc=com";
$password = "qwerty";

// Conexto donde se encuentran los usuarios
$basedn = "uid=$name,cn=usuarios,ou=grupos,dc=botellamunoz,dc=com";

// Establecer la conexión con el servidor LDAP
$ds = ldap_connect("ldap://{$host}:{$port}") or die("No se pudo conectar al servidor LDAP.");

if ($ds) {
    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3); // IMPORTANT
    $result = ldap_bind($ds, $dnbind, $password); //BIND
    if (!$result) {
        echo "Not Binded";
    }

    // Preparando las Caracteristicas del Usuario
    $ldaprecord['objectClass'][0] = "inetOrgPerson";
    $ldaprecord['objectClass'][1] = "posixAccount";
    $ldaprecord['objectClass'][2] = "shadowAccount";
    $ldaprecord['uid'] = $name;
    $ldaprecord['cn'] = $name;
    $ldaprecord['sn'] = "usuario";
    $ldaprecord['givenName'] = $name;
    $ldaprecord['userPassword'] = $passwd;
    $ldaprecord['uidnumber'] = $uidnumber;
    $ldaprecord['gidNumber'] = "5001";
    $ldaprecord['displayName'] = $name;
    $ldaprecord['loginshell'] = "/bin/bash";
    $ldaprecord['homedirectory'] = "/home/recorder/";

    $r = ldap_add($ds, $basedn, $ldaprecord);
    if ($r) {
        header("Location: ../html/index.html");
        die();
    } else {
        header("Location: ../html/registrar.html");
        die();
   }
} else {
    echo "<h2>No se Puede Conectar al Servidor LDAP en $host, Intentelo de Nuevo más Tarde</h2>";
}

?>